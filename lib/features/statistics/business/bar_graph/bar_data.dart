/**
 * Company: CETAM
 * Project: QParking
 * File: bar_data.dart
 * Created on: 15/11/2025
 * Created by: Daniel Yair Mendoza Alvarez
 * Approved by: Daniel Yair Mendoza Alvarez
 *
 */
import 'package:qparking/features/statistics/statistics_exports.dart';

class BarData {
  final double monHrs;
  final double tueHrs;
  final double wedHrs;
  final double thuHrs;
  final double friHrs;
  final double satHrs;
  final double sunHrs;
  List<IndividualBar> barData = [];

  void initBarData() {
    barData = [
      IndividualBar(x: 0, y: monHrs),
      IndividualBar(x: 1, y: tueHrs),
      IndividualBar(x: 2, y: wedHrs),
      IndividualBar(x: 3, y: thuHrs),
      IndividualBar(x: 4, y: friHrs),
      IndividualBar(x: 5, y: satHrs),
      IndividualBar(x: 6, y: sunHrs),
    ];
  }

  BarData({
    required this.monHrs,
    required this.tueHrs,
    required this.wedHrs,
    required this.thuHrs,
    required this.friHrs,
    required this.satHrs,
    required this.sunHrs,
  });
}
