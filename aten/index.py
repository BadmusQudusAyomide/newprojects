import os
import cv2
import face_recognition
import numpy as np
import pandas as pd
from datetime import datetime

# Step 1: Create Directories
dataset_dir = "dataset"
attendance_dir = "attendance"

os.makedirs(dataset_dir, exist_ok=True)
os.makedirs(attendance_dir, exist_ok=True)

# Step 2: Capture and Store Images
def capture_images(student_name):
    cap = cv2.VideoCapture(0)
    count = 0
    
    while True:
        ret, frame = cap.read()
        if not ret:
            break
        
        cv2.imshow("Frame", frame)
        
        img_path = os.path.join(dataset_dir, f"{student_name}_{count}.jpg")
        cv2.imwrite(img_path, frame)
        count += 1
        
        key = cv2.waitKey(1)
        if key == 27 or count >= 30:  # Press Esc to exit or after 30 captures
            break
    
    cap.release()
    cv2.destroyAllWindows()

# Example usage
# capture_images("student_name")

# Step 3: Encode Faces
def encode_faces(dataset_dir):
    known_encodings = []
    known_names = []

    for file_name in os.listdir(dataset_dir):
        if file_name.endswith(".jpg"):
            img_path = os.path.join(dataset_dir, file_name)
            image = face_recognition.load_image_file(img_path)
            encoding = face_recognition.face_encodings(image)[0]
            
            known_encodings.append(encoding)
            known_names.append(file_name.split("_")[0])
    
    return known_encodings, known_names

# Step 4: Log Attendance
def log_attendance(name):
    now = datetime.now()
    date_str = now.strftime("%Y-%m-%d")
    time_str = now.strftime("%H:%M:%S")
    attendance_file = os.path.join(attendance_dir, f"{date_str}.csv")
    
    if not os.path.exists(attendance_file):
        df = pd.DataFrame(columns=["Name", "Date", "Time"])
    else:
        df = pd.read_csv(attendance_file)
    
    if not ((df['Name'] == name) & (df['Date'] == date_str)).any():
        df = df.append({"Name": name, "Date": date_str, "Time": time_str}, ignore_index=True)
        df.to_csv(attendance_file, index=False)

# Step 5: Recognize Faces and Log Attendance
def recognize_faces(known_encodings, known_names):
    cap = cv2.VideoCapture(0)

    while True:
        ret, frame = cap.read()
        if not ret:
            break
        
        rgb_frame = frame[:, :, ::-1]  # Convert BGR to RGB
        
        face_locations = face_recognition.face_locations(rgb_frame)
        face_encodings = face_recognition.face_encodings(rgb_frame, face_locations)
        
        for (top, right, bottom, left), face_encoding in zip(face_locations, face_encodings):
            matches = face_recognition.compare_faces(known_encodings, face_encoding)
            name = "Unknown"
            
            face_distances = face_recognition.face_distance(known_encodings, face_encoding)
            best_match_index = np.argmin(face_distances)
            
            if matches[best_match_index]:
                name = known_names[best_match_index]
            
            cv2.rectangle(frame, (left, top), (right, bottom), (0, 255, 0), 2)
            cv2.putText(frame, name, (left, top - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 255, 0), 2)
            
            log_attendance(name)
        
        cv2.imshow("Frame", frame)
        
        key = cv2.waitKey(1)
        if key == 27:  # Press Esc to exit
            break
    
    cap.release()
    cv2.destroyAllWindows()

# Example usage
# 1. Capture images of students (do this for each student)
# capture_images("student_name")

# 2. Encode the captured images
# known_encodings, known_names = encode_faces(dataset_dir)

# 3. Recognize faces and log attendance
# recognize_faces(known_encodings, known_names)
