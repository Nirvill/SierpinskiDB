from flask import Flask, request, jsonify
import os
from dotenv import load_dotenv
import mysql.connector

load_dotenv()

app = Flask(__name__)

db = mysql.connector.connect(
    host=os.getenv("DB_HOST"),
    user=os.getenv("DB_USER"),
    password=os.getenv("DB_PASS"),
    database=os.getenv("DB_NAME")
)

@app.route("../public_html/search")
def search():
    q = request.args.get("q", "")
    cursor = db.cursor(dictionary=True)
    cursor.execute("SELECT Nickname FROM Replika WHERE nickname LIKE %s LIMIT 10", [f"%{q}%"])
    results = cursor.fetchall()
    return jsonify(results=results)

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
