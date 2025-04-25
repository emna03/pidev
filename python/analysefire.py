# analysefire.py
from ultralytics import YOLO
import sys
import json
import os

# === 1. Charger le modèle ===
def load_model():
    model_path = "best.pt"
    if not os.path.exists(model_path):
        print(json.dumps({"error": f"Model not found: {model_path}"}))
        sys.exit(1)
    model = YOLO(model_path)
    return model

# === 2. Lire l'image ===
def read_image(image_path):
    if not os.path.exists(image_path):
        print(json.dumps({"error": f"Image not found: {image_path}"}))
        sys.exit(1)
    return image_path

# === 3. Effectuer la détection sur l'image ===
def detect_fire(image_path, model):
    results = model(image_path)
    if not results:
        print(json.dumps({"error": "No detection results found"}))
        sys.exit(1)
    return results

# === 4. Analyser les résultats ===
def analyze_results(results):
    detected_classes = results[0].boxes.cls.tolist()
    class_names = results[0].names
    objects_detected = [class_names[int(cls)] for cls in detected_classes]
    fire_count = objects_detected.count("fire")
    danger_level = 1  # Niveau de danger par défaut
    if fire_count > 0:
        danger_level = 3  # Niveau de danger élevé si le feu est détecté

    output = {
        "fire_detected": fire_count > 0,
        "fire_count": fire_count,
        "danger_level": danger_level,
        "objects_detected": objects_detected
    }

    return output

# === 5. Sauvegarder l'image annotée (optionnelle) ===
def save_annotated_image(results, image_path):
    output_image_path = os.path.join(os.path.dirname(image_path), "output_detected.jpg")
    results[0].save(filename=output_image_path)

# === 6. Main function ===
if __name__ == "__main__":
    if len(sys.argv) < 2:
        print(json.dumps({"error": "Image path not provided"}))
        sys.exit(1)

    image_path = sys.argv[1]
    image_path = read_image(image_path)

    model = load_model()
    results = detect_fire(image_path, model)
    output = analyze_results(results)

    save_annotated_image(results, image_path)

    print(json.dumps(output))
