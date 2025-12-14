/**
 * Company: CETAM
 * Project: QParking
 * File: app_router.dart
 * Created on: 15/11/2025
 * Created by: Daniel Yair Mendoza Alvarez
 * Approved by: Daniel Yair Mendoza Alvarez
 */

 import 'package:intl/intl.dart';

class TimeFormat {
  static String secondsToTimeFormat({required totalSeconds}) {
    int hours = totalSeconds ~/ 3600;
    int minutes = (totalSeconds % 3600) ~/ 60;
    int seconds = totalSeconds % 60;
    final timeFormat = NumberFormat("00");
    return "${timeFormat.format(hours)}:${timeFormat.format(minutes)}:${timeFormat.format(seconds)}";
  }
}
