import cv2
import numpy as np
import os

MODEL_PATH = os.path.join(os.path.dirname(__file__), "arcfaceresnet100-8.onnx")

# 🔧 Seuils renforcés
SHARPNESS_THRESHOLD = 120
BRIGHTNESS_MIN = 90
BRIGHTNESS_MAX = 210
VARIANCE_THRESHOLD = 0.04  # tolérance entre embeddings

def calculate_sharpness(image):
    return cv2.Laplacian(image, cv2.CV_64F).var()

def load_model(path):
    if not os.path.exists(path):
        raise FileNotFoundError(f"Model file not found: {path}")
    return cv2.dnn.readNetFromONNX(path)

def embeddings_variance(embeddings):
    return np.mean(np.var(embeddings, axis=0))

def get_face_embedding():
    cap = cv2.VideoCapture(0)
    if not cap.isOpened():
        raise IOError("Cannot open webcam")

    embeddings = []
    required_captures = 30
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
    net = load_model(MODEL_PATH)

    captured_faces = []

    try:
        start_time = cv2.getTickCount()
        frame_skip = 3
        frame_count = 0

        while len(captured_faces) < required_captures and (cv2.getTickCount() - start_time) / cv2.getTickFrequency() < 30:
            ret, frame = cap.read()
            if not ret:
                continue

            frame_count += 1
            if frame_count % frame_skip != 0:
                continue

            gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
            faces = face_cascade.detectMultiScale(gray, scaleFactor=1.1, minNeighbors=5, minSize=(120, 120))

            if len(faces) > 0:
                largest_face = sorted(faces, key=lambda f: f[2] * f[3], reverse=True)[0]
                x, y, w, h = largest_face

                pad = int(0.1 * w)
                x1, y1 = max(0, x - pad), max(0, y - pad)
                x2, y2 = min(frame.shape[1], x + w + pad), min(frame.shape[0], y + h + pad)
                face_img = frame[y1:y2, x1:x2]

                if face_img.shape[0] < 100 or face_img.shape[1] < 100:
                    print("⛔ Rejeté — visage trop petit")
                    continue

                face_resized = cv2.resize(face_img, (112, 112))
                gray_face = cv2.cvtColor(face_resized, cv2.COLOR_BGR2GRAY)

                sharpness = calculate_sharpness(gray_face)
                brightness = np.mean(gray_face)

                if sharpness < SHARPNESS_THRESHOLD or brightness < BRIGHTNESS_MIN or brightness > BRIGHTNESS_MAX:
                    print(f"⛔ Rejeté — sharpness={sharpness:.1f}, brightness={brightness:.1f}")
                    continue

                blob = cv2.dnn.blobFromImage(face_resized, 1/127.5, (112, 112), (127.5, 127.5, 127.5), swapRB=True)
                net.setInput(blob)
                embedding = net.forward().flatten()

                norm = np.linalg.norm(embedding)
                if norm > 0:
                    embedding = embedding / norm

                captured_faces.append((sharpness, embedding))

                cv2.putText(frame, f"Capture {len(captured_faces)}/{required_captures}", (10, 30),
                            cv2.FONT_HERSHEY_SIMPLEX, 0.8, (0, 255, 0), 2)
                cv2.waitKey(300)

            cv2.imshow('Camera', frame)
            if cv2.waitKey(1) & 0xFF == ord('q'):
                break

    finally:
        cap.release()
        cv2.destroyAllWindows()

    captured_faces.sort(reverse=True, key=lambda x: x[0])
    best_embeddings = [emb for _, emb in captured_faces[:5]]

    if len(best_embeddings) >= 5:
        variance = embeddings_variance(best_embeddings)
        print(f"📊 Variance entre les top 5 embeddings : {variance:.5f}")

        if variance > VARIANCE_THRESHOLD:
            print("⚠️ Variance trop élevée — visage instable, refusé")
            return None

        mean_embedding = np.mean(best_embeddings, axis=0)
        print("✅ Embedding final généré")
        return mean_embedding

    print("❌ Pas assez de visages nets capturés")
    return None

def embedding_to_string(embedding):
    return ' '.join(map(str, embedding))

