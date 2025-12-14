/**
 * Company: CETAM
 * Project: QParking
 * File: parking_map_screen.dart
 * Created on: 14/12/2025
 * Created by: Gamaliel Alejandro Juarez Loyde
 * Approved by: Daniel Yair Mendoza
 *
 * Description: Interactive map with AppBar controls and Bottom Floating Search Filter.
 */

import 'dart:async';
import 'package:flutter/material.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:geolocator/geolocator.dart';
import 'package:go_router/go_router.dart';
import 'package:qparking/core/constants/constants_exports.dart';
// Import the service
import 'package:qparking/features/map/data/services/parking_service.dart';

class ParkingMapScreen extends StatefulWidget {
  const ParkingMapScreen({super.key});

  @override
  State<ParkingMapScreen> createState() => _ParkingMapScreenState();
}

class _ParkingMapScreenState extends State<ParkingMapScreen> {
  final Completer<GoogleMapController> _controller = Completer();
  final ParkingService _parkingService = ParkingService();

  // Initial Coordinates (Default fallback)
  static const CameraPosition _kInitialPosition = CameraPosition(
    target: LatLng(19.4326, -99.1332),
    zoom: 14.5,
  );

  // Markers & Data
  final Set<Marker> _markers = {};
  Map<String, dynamic>? _selectedParking;

  // Search Radius State (Default 5km)
  double _searchRadius = 5.0;
  bool _isChangingRadius = false;

  @override
  void initState() {
    super.initState();
    // Load markers from the "Database" (Service)
    _loadMarkersFromDB();
    // Auto-locate user on start
    _goToMyPosition();
  }

  /// Fetches data from the Service and updates the map markers
  Future<void> _loadMarkersFromDB() async {
    try {
      final parkingList = await _parkingService.getParkingLots();

      setState(() {
        _markers.clear(); // Clear existing markers
        for (var parking in parkingList) {
          _markers.add(
            Marker(
              markerId: MarkerId(parking['id']),
              position: LatLng(parking['lat'], parking['lng']),
              // Use hue from data or default to red
              icon: BitmapDescriptor.defaultMarkerWithHue(parking['color_hue'] ?? BitmapDescriptor.hueRed),
              onTap: () {
                setState(() {
                  _selectedParking = parking;
                });
                _animateToLocation(parking['lat'], parking['lng'], zoom: 16.0);
              },
            ),
          );
        }
      });
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Error loading map data from database.')),
        );
      }
    }
  }

  Future<void> _animateToLocation(double lat, double lng, {double zoom = 15.0}) async {
    final GoogleMapController controller = await _controller.future;
    controller.animateCamera(CameraUpdate.newCameraPosition(
      CameraPosition(target: LatLng(lat, lng), zoom: zoom),
    ));
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: SCAFFOLD_BACKGROUND,

      // --- 1. Institutional AppBar (Figure 42 Requirement) ---
      appBar: AppBar(
        backgroundColor: PRIMARY_COLOR,
        elevation: 0,
        centerTitle: true,
        // Menu Icon (Left)
        leading: IconButton(
          icon: const Icon(Icons.menu, color: WHITE_COLOR),
          onPressed: () {
            // Logic to open drawer or go back
            context.pop();
          },
        ),
        // Title (Center)
        title: const Text(
          'Mapa de estacionamientos',
          style: TextStyle(
            color: WHITE_COLOR,
            fontFamily: 'Noto Sans',
            fontWeight: FontWeight.bold,
            fontSize: 18,
          ),
        ),
        actions: [
          // Location Button (Right)
          IconButton(
            icon: const Icon(Icons.my_location, color: WHITE_COLOR),
            onPressed: _goToMyPosition,
          ),
        ],
      ),

      body: Stack(
        children: [
          // --- 2. Background Map ---
          GoogleMap(
            mapType: MapType.normal,
            initialCameraPosition: _kInitialPosition,
            markers: _markers,
            // Visual circle for search radius
            circles: {
              Circle(
                circleId: const CircleId('searchRadius'),
                center: const LatLng(19.4326, -99.1332), // Should update to user pos
                radius: _searchRadius * 1000,
                fillColor: PRIMARY_COLOR.withOpacity(0.05),
                strokeColor: PRIMARY_COLOR.withOpacity(0.3),
                strokeWidth: 1,
              )
            },
            myLocationEnabled: true,
            myLocationButtonEnabled: false,
            zoomControlsEnabled: false,
            mapToolbarEnabled: false,
            onMapCreated: (GoogleMapController controller) {
              _controller.complete(controller);
            },
            onTap: (_) {
              if (_selectedParking != null) {
                setState(() => _selectedParking = null);
              }
            },
          ),

          // --- 3. Bottom Floating Filter (Rounded & Centered) ---
          if (_selectedParking == null)
            Positioned(
              left: 24,
              right: 24,
              bottom: 32,
              child: AnimatedContainer(
                duration: const Duration(milliseconds: 300),
                padding: const EdgeInsets.all(20),
                decoration: BoxDecoration(
                  color: WHITE_COLOR,
                  borderRadius: BorderRadius.circular(24),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.15),
                      blurRadius: 15,
                      offset: const Offset(0, 5),
                    ),
                  ],
                ),
                child: _isChangingRadius
                    ? _buildRadiusSlider()
                    : _buildRadiusInfo(),
              ),
            ),

          // --- 4. Detail Card (On Marker Selection) ---
          if (_selectedParking != null)
            Positioned(
              left: 16,
              right: 16,
              bottom: 32,
              child: _buildParkingDetailCard(_selectedParking!),
            ),
        ],
      ),
    );
  }

  /// View 1: Summary Info
  Widget _buildRadiusInfo() {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      children: [
        Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          mainAxisSize: MainAxisSize.min,
          children: [
            Text(
              '${_markers.length} Estacionamientos',
              style: const TextStyle(
                fontWeight: FontWeight.bold,
                fontSize: 16,
                color: GRAY_900,
                fontFamily: 'Noto Sans',
              ),
            ),
            const SizedBox(height: 4),
            Text(
              'Radio de búsqueda: ${_searchRadius.toInt()} km',
              style: const TextStyle(
                fontSize: 14,
                color: GRAY_600,
                fontFamily: 'Noto Sans',
              ),
            ),
          ],
        ),

        TextButton(
          onPressed: () {
            setState(() {
              _isChangingRadius = true;
            });
          },
          style: TextButton.styleFrom(
            foregroundColor: PRIMARY_COLOR,
            padding: EdgeInsets.zero,
            tapTargetSize: MaterialTapTargetSize.shrinkWrap,
          ),
          child: const Text(
            'Cambiar radio',
            style: TextStyle(
              fontWeight: FontWeight.bold,
              fontSize: 14,
              fontFamily: 'Noto Sans',
            ),
          ),
        ),
      ],
    );
  }

  /// View 2: Radius Slider
  Widget _buildRadiusSlider() {
    return Column(
      mainAxisSize: MainAxisSize.min,
      children: [
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            const Text(
              'Ajustar Radio',
              style: TextStyle(
                fontSize: 14,
                fontWeight: FontWeight.bold,
                color: GRAY_900,
                fontFamily: 'Noto Sans',
              ),
            ),
            Text(
              '${_searchRadius.toInt()} km',
              style: const TextStyle(
                fontSize: 14,
                fontWeight: FontWeight.bold,
                color: PRIMARY_COLOR,
                fontFamily: 'Noto Sans',
              ),
            ),
          ],
        ),
        const SizedBox(height: 8),
        SliderTheme(
          data: SliderTheme.of(context).copyWith(
            activeTrackColor: PRIMARY_COLOR,
            inactiveTrackColor: GRAY_200,
            thumbColor: PRIMARY_COLOR,
            overlayColor: PRIMARY_COLOR.withOpacity(0.2),
            trackHeight: 4.0,
            thumbShape: const RoundSliderThumbShape(enabledThumbRadius: 8),
          ),
          child: Slider(
            value: _searchRadius,
            min: 1,
            max: 20,
            divisions: 19,
            onChanged: (value) {
              setState(() {
                _searchRadius = value;
              });
            },
          ),
        ),
        const SizedBox(height: 8),
        SizedBox(
          width: double.infinity,
          height: 40,
          child: ElevatedButton(
            onPressed: () {
              setState(() {
                _isChangingRadius = false;
                // Here you would trigger a database reload with new radius
                _loadMarkersFromDB();
              });
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: PRIMARY_COLOR,
              foregroundColor: WHITE_COLOR,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(8),
              ),
            ),
            child: const Text('Aplicar Búsqueda'),
          ),
        ),
      ],
    );
  }

  /// Builds the detail card for the selected parking lot
  Widget _buildParkingDetailCard(Map<String, dynamic> parking) {
    final bool isAvailable = parking['available_spots'] > 0;

    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: WHITE_COLOR,
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.15),
            blurRadius: 15,
            offset: const Offset(0, 5),
          ),
        ],
      ),
      child: Column(
        mainAxisSize: MainAxisSize.min,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Expanded(
                child: Text(
                  parking['title'],
                  style: const TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                    color: PRIMARY_COLOR,
                    fontFamily: 'Noto Sans',
                  ),
                ),
              ),
              IconButton(
                icon: const Icon(Icons.close, color: GRAY_500),
                onPressed: () => setState(() => _selectedParking = null),
                padding: EdgeInsets.zero,
                constraints: const BoxConstraints(),
              ),
            ],
          ),
          const SizedBox(height: 4),
          Text(
            parking['status'],
            style: TextStyle(
              color: isAvailable ? SUCCESS_COLOR : DANGER_COLOR,
              fontWeight: FontWeight.bold,
              fontSize: 12,
            ),
          ),
          const SizedBox(height: 12),
          Row(
            children: [
              const Icon(Icons.location_on, size: 16, color: GRAY_500),
              const SizedBox(width: 4),
              Expanded(
                child: Text(
                  parking['address'],
                  style: const TextStyle(
                    color: GRAY_600,
                    fontSize: 14,
                    fontFamily: 'Noto Sans',
                  ),
                  maxLines: 2,
                  overflow: TextOverflow.ellipsis,
                ),
              ),
            ],
          ),
          const SizedBox(height: 16),
          SizedBox(
            width: double.infinity,
            child: ElevatedButton(
              onPressed: isAvailable ? () {} : null,
              style: ElevatedButton.styleFrom(
                backgroundColor: PRIMARY_COLOR,
                foregroundColor: WHITE_COLOR,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(8),
                ),
              ),
              child: const Text('Ver Detalles'),
            ),
          ),
        ],
      ),
    );
  }

  Future<void> _goToMyPosition() async {
    bool serviceEnabled;
    LocationPermission permission;

    serviceEnabled = await Geolocator.isLocationServiceEnabled();
    if (!serviceEnabled) {
      if(mounted) ScaffoldMessenger.of(context).showSnackBar(const SnackBar(content: Text('Ubicación desactivada')));
      return;
    }

    permission = await Geolocator.checkPermission();
    if (permission == LocationPermission.denied) {
      permission = await Geolocator.requestPermission();
      if (permission == LocationPermission.denied) return;
    }

    if (permission == LocationPermission.deniedForever) return;

    try {
      Position position = await Geolocator.getCurrentPosition(
        desiredAccuracy: LocationAccuracy.high,
      );

      final GoogleMapController controller = await _controller.future;
      controller.animateCamera(CameraUpdate.newCameraPosition(
        CameraPosition(
          target: LatLng(position.latitude, position.longitude),
          zoom: 16.0,
        ),
      ));
    } catch (e) {
      // Handle error
    }
  }
}