from ultralytics import YOLO
import sys
import json

# Charger le modèle YOLO
model = YOLO("C:/Users/ichaa/Desktop/ESPRIT/ESPRIT 3A/Git Projects/integration mourad/ProjetPi/public/python/yolov8n.pt")
# Charger l'imag
image_path = sys.argv[1]
results = model(image_path)

# Analyser les objets détectés
detected_classes = results[0].boxes.cls.tolist()
class_names = results[0].names
objects_detected = [class_names[int(cls)] for cls in detected_classes]

# Compter les objets
car_count = objects_detected.count("car")
truck_count = objects_detected.count("truck")
person_count = objects_detected.count("person")

# 🔥 Nouvelle logique de danger
if person_count >= 5 and (car_count >= 2 or truck_count >= 2):
    danger_level = 3  # Accident probable, beaucoup de personnes et de véhicules
elif person_count >= 3 and (car_count >= 2 or truck_count >= 1):
    danger_level = 2  # Circulation dense avec des personnes
else:
    danger_level = 1  # Faible danger

# Résultat
output = {
    "objects_detected": list(set(objects_detected)),
    "danger_level": danger_level
}

print(json.dumps(output, indent=4))
