import 'dart:convert';
import 'dart:developer';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:mobile_game/model/order.dart';
import 'package:mobile_game/model/product.dart';

class OrderController {
  Future<List<Order>> fetchOrder(Product p) async {
    dynamic response = await http.post(Uri.parse("http://192.168.0.190/Game/flutter_mobile/mobile_game/php_process/show_order.php"), 
      body: {
        'username': p.username,
        'type': p.type
      }
    );

    var orderdata = json.decode(response.body);

    List<Order> list = [];
    
    list = List<Order>.from(orderdata.map((e) => Order.fromJson(e)));

    return list;
  }
}