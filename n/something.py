import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import schedule
import time
import os

# Fetch email credentials from environment variables
smtp_server = "smtp.gmail.com"
smtp_port = 587
sender_email = os.getenv("EMAIL_USER")
sender_password = os.getenv("EMAIL_PASS")

def send_email():
    # Define the email content
    to_email = "qudusay192@gmail.com"
    subject = "Daily Report"
    body = "This is the body of the daily report. That will be sent every morning"

    # Create the email message
    msg = MIMEMultipart()
    msg['From'] = sender_email
    msg['To'] = to_email
    msg['Subject'] = subject

    # Attach the body with the msg instance
    msg.attach(MIMEText(body, 'plain'))

    # Create the server connection
    server = smtplib.SMTP(smtp_server, smtp_port)
    server.starttls()  # Secure the connection
    server.login(sender_email, sender_password)
    text = msg.as_string()
    server.sendmail(sender_email, to_email, text)
    server.quit()

    print(f"Email sent to {to_email}")

def job():
    send_email()

# Schedule the job every day at a specific time (e.g., 8:00 AM)
schedule.every().day.at("04:50").do(job)

while True:
    schedule.run_pending()
    time.sleep(1)
