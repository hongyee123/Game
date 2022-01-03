
import 'dart:convert';
import 'dart:developer';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';

class ProductController {
  Future<List<Product>> fetchProduct(User user) async {
    dynamic response = await http.post(Uri.parse("http://192.168.0.190/Game/flutter_mobile/mobile_game/php_process/show_product.php"), 
      body: {
        'username': user.username
      }
    );

    var productdata = json.decode(response.body);

    List<Product> list = [];
    
    list = List<Product>.from(productdata.map((e) => Product.fromJson(e)));

    return list;
  }

  Future<int> addCart(String username, String id, int qty) async {
    dynamic response = await http.post(Uri.parse("http://192.168.0.190/Game/flutter_mobile/mobile_game/php_process/add_cart.php"), 
      body: {
        'username': username,
        'id': id,
        'quantity': qty.toString()
      }
    );

    var addcart = json.decode(response.body);

    int status;
    status = addcart["status"];
    return status;
  }
}