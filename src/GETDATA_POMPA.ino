#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

// Isi dengan SSID dan kata sandi WiFi Anda
const char* ssid = "ntah";
const char* password = "testing1";
const int soilMoisturePin = A0;  // Pin ADC untuk soil moisture sensor
const int pumpPin = D1;          // Pin yang mengontrol pompa
const int moistureThreshold = 580; // Ambang kelembaban tanah; sesuaikan sesuai kebutuhan Anda

// Isi dengan URL yang akan Anda akses
const char* url = "http://monitoringtansawi.000webhostapp.com/api/postdata.php?sensor=";

void setup() {
  Serial.begin(115200);

  // Hubungkan ke WiFi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");

  pinMode(soilMoisturePin, INPUT);
  pinMode(pumpPin, OUTPUT);
  digitalWrite(pumpPin, LOW); // Pastikan pompa dimatikan pada awalnya
}

void loop() {
  const int value = analogRead(soilMoisturePin);
  if (value < moistureThreshold) {
    // Jika kelembaban tanah turun di bawah angka, aktifkan pompa
    digitalWrite(pumpPin, HIGH);
    delay(500);
  } else {
    // Jika kelembaban tanah mencukupi, matikan pompa
    digitalWrite(pumpPin, LOW);
    delay(500);
  }
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    WiFiClient client;

    // Mulai permintaan HTTP GET
    String get = url + String(value);
    http.begin(client, get);

    // Lakukan permintaan dan dapatkan status respons
    int httpCode = http.GET();

    if (httpCode > 0) {
      // Jika respons berhasil, baca isi respons
      String payload = http.getString();
      Serial.println("HTTP Response: " + payload);
    } else {
      Serial.println("HTTP GET failed: " + http.errorToString(httpCode));
    }

    // Akhiri permintaan
    http.end();

    // Tunggu sejenak sebelum melakukan permintaan berikutnya
    delay(1000);
  }
}
