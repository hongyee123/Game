import 'dart:convert';
import 'dart:developer';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:mobile_game/model/detail.dart';
import 'package:mobile_game/model/order.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';

class OrderController {
  Future<List<Order>> fetchOrder(Product p) async {
    dynamic response = await http.post(Uri.parse("http://192.168.0.144/Game/flutter_mobile/mobile_game/php_process/show_order.php"), 
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

  Future<List<Detail>> fetchOrderDetail(User u) async {
    dynamic response = await http.post(Uri.parse("http://192.168.0.144/Game/flutter_mobile/mobile_game/php_process/show_detail.php"), 
      body: {
        'username': u.username
      }
    );

    var detaildata = json.decode(response.body);

    List<Detail> list = [];
    
    list = List<Detail>.from(detaildata.map((e) => Detail.fromJson(e)));

    return list;
  }
}