from flask import Flask, request, jsonify
import os
from dotenv import load_dotenv
import mysql.connector

load_dotenv()

app = Flask(__name__)

def get_db():
    return mysql.connector.connect(
        host=os.getenv("DB_HOST"),
        user=os.getenv("DB_USER"),
        password=os.getenv("DB_PASS"),
        database=os.getenv("DB_NAME")
    )

@app.route("/search")
def search():
    q = request.args.get("q", "")
    if not q:
        return jsonify(results=[])

    db = get_db()
    cursor = db.cursor(dictionary=True)
    cursor.execute("SELECT Nickname FROM Replika WHERE Nickname LIKE %s LIMIT 10", [f"%{q}%"])
    results = cursor.fetchall()
    cursor.close()
    db.close()

    return jsonify(results=results)

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
