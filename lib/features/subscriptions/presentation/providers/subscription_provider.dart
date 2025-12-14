/**
 * Company: CETAM
 * Project: QParking
 * File: subscription_provider.dart
 * Created on: 13/12/2025
 * Created by: Rodrigo Peña Vega
 * Approved by: Gamaliel Alejandro Juarez Loyde

 */

import 'package:flutter_riverpod/flutter_riverpod.dart';

final hasActivePlanProvider = StateProvider<bool>((ref) => false);