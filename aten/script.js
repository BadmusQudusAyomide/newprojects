const video = document.getElementById("video");

// Geofence coordinates (latitude, longitude) and radius (in meters)
const geofence = {
  latitude: 6.5568768, // Example: New York City latitude
  longitude: 3.325952, // Example: New York City longitude
  radius: 100, // Example: 100 meters
};

// Load face-api models
Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri(
    "https://cdn.jsdelivr.net/npm/@vladmandic/face-api@0.22.2/models"
  ),
  faceapi.nets.faceLandmark68Net.loadFromUri(
    "https://cdn.jsdelivr.net/npm/@vladmandic/face-api@0.22.2/models"
  ),
  faceapi.nets.faceRecognitionNet.loadFromUri(
    "https://cdn.jsdelivr.net/npm/@vladmandic/face-api@0.22.2/models"
  ),
]).then(startVideo);

function startVideo() {
  navigator.getUserMedia(
    { video: {} },
    (stream) => (video.srcObject = stream),
    (err) => console.error(err)
  );
}

document.getElementById("capture").addEventListener("click", () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(checkGeofence);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
});

function checkGeofence(position) {
  const userLatitude = position.coords.latitude;
  const userLongitude = position.coords.longitude;
  const distance = getDistance(
    userLatitude,
    userLongitude,
    geofence.latitude,
    geofence.longitude
  );

  if (distance <= geofence.radius) {
    captureAttendance();
  } else {
    alert("You are not within the allowed area to mark attendance.");
  }
}

function getDistance(lat1, lon1, lat2, lon2) {
  const R = 6371e3; // Earth radius in meters
  const φ1 = (lat1 * Math.PI) / 180;
  const φ2 = (lat2 * Math.PI) / 180;
  const Δφ = ((lat2 - lat1) * Math.PI) / 180;
  const Δλ = ((lon2 - lon1) * Math.PI) / 180;

  const a =
    Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
    Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

  return R * c; // Distance in meters
}

async function captureAttendance() {
  const detections = await faceapi
    .detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
    .withFaceLandmarks()
    .withFaceDescriptors();
  const displaySize = { width: video.width, height: video.height };
  faceapi.matchDimensions(video, displaySize);
  const resizedDetections = faceapi.resizeResults(detections, displaySize);

  // Assuming you have labeled face descriptors loaded
  const labeledDescriptors = await loadLabeledImages();
  const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.6);

  const results = resizedDetections.map((d) =>
    faceMatcher.findBestMatch(d.descriptor)
  );

  results.forEach((result) => {
    const name = result.toString().split(" ")[0];
    document.getElementById("result").innerText += `${name} is present.\n`;

    // Sending attendance to server
    fetch("process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ name }),
    });
  });
}

async function loadLabeledImages() {
  const labels = ["Student1", "Student2"]; // Add more students
  return Promise.all(
    labels.map(async (label) => {
      const descriptions = [];
      for (let i = 1; i <= 2; i++) {
        // Number of images per student
        const img = await faceapi.fetchImage(`uploads/${label}/${i}.jpg`);
        const detections = await faceapi
          .detectSingleFace(img)
          .withFaceLandmarks()
          .withFaceDescriptor();
        descriptions.push(detections.descriptor);
      }
      return new faceapi.LabeledFaceDescriptors(label, descriptions);
    })
  );
}
