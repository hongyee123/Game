import 'dart:convert';
import 'dart:developer';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:mobile_game/model/order.dart';
import 'package:mobile_game/model/cart.dart';
import 'package:mobile_game/model/user.dart';

class CartController {
  Future<List<Cart>> fetchCart(User user) async {
    dynamic response = await http.post(Uri.parse("http://192.168.0.190/Game/flutter_mobile/mobile_game/php_process/show_cart.php"), 
      body: {
        'username': user.username,
      }
    );

    var cartdata = json.decode(response.body);

    List<Cart> list = [];
    
    list = List<Cart>.from(cartdata.map((e) => Cart.fromJson(e)));

    return list;
  }
}