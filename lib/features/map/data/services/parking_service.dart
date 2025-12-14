/**
 * Company: CETAM
 * Project: QParking
 * File: parking_service.dart
 * Created on: 14/12/2025
 * Created by: Fix Bot
 * Description: Service layer to fetch parking data from external Database/API.
 * Prepared for Laragon/Localhost connection.
 */

import 'dart:async';
// import 'dart:convert'; // Uncomment when using real API
// import 'package:http/http.dart' as http; // Uncomment for real API requests

class ParkingService {
  // CONFIGURATION FOR LARAGON / LOCALHOST
  // Android Emulator: Use '10.0.2.2' to access localhost
  // iOS Simulator / Real Device: Use your PC's local IP (e.g., '192.168.1.50')
  // static const String _baseUrl = 'http://10.0.2.2/qparking/api';

  /// Fetches the list of parking lots from the database.
  /// Returns a Future List of Map data.
  Future<List<Map<String, dynamic>>> getParkingLots() async {
    // --- REAL IMPLEMENTATION PATTERN (Ready for Laragon) ---
    /*
    try {
      final response = await http.get(Uri.parse('$_baseUrl/parking-lots'));

      if (response.statusCode == 200) {
        // Parse JSON response from Laragon API
        final List<dynamic> data = json.decode(response.body);
        return data.cast<Map<String, dynamic>>();
      } else {
        throw Exception('Failed to connect to Database: ${response.statusCode}');
      }
    } catch (e) {
      // Log error properly in a real app
      print('DB Connection Error: $e');
      return [];
    }
    */

    // --- MOCK IMPLEMENTATION (Simulates DB Response Time) ---
    // This allows the app to be functional while API is being developed.
    await Future.delayed(const Duration(milliseconds: 800));

    return [
      {
        'id': 'p1',
        'title': 'QParking Centro',
        'address': 'Av. Juárez 101, Centro Histórico',
        'status': 'Disponible',
        'lat': 19.4326,
        'lng': -99.1332,
        'color_hue': 210.0, // Azure hue (Blue)
        'available_spots': 45,
      },
      {
        'id': 'p2',
        'title': 'QParking Alameda',
        'address': 'Calle Dr. Mora 15, Colonia Centro',
        'status': 'Lleno',
        'lat': 19.4350,
        'lng': -99.1350,
        'color_hue': 0.0, // Red hue
        'available_spots': 0,
      },
      {
        'id': 'p3',
        'title': 'QParking Reforma',
        'address': 'Paseo de la Reforma 222',
        'status': 'Disponible',
        'lat': 19.4290,
        'lng': -99.1600,
        'color_hue': 120.0, // Green hue
        'available_spots': 12,
      },
    ];
  }
}