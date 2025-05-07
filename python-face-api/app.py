from flask import Flask, jsonify
from face_recognition import get_face_embedding, embedding_to_string

app = Flask(__name__)

@app.route('/generate-embedding', methods=['GET'])
def generate_embedding():
    embedding = get_face_embedding()
    if embedding is not None:
        return jsonify({
            'status': 'success',
            'embedding': embedding_to_string(embedding)
        })
    else:
        return jsonify({
            'status': 'error',
            'message': 'Aucun visage détecté'
        }), 400

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
