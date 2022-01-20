import 'dart:convert';
import 'dart:developer';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:mobile_game/model/favorite.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';


class FavoriteController {
  Future<List<Favorite>> fetchFavorite(User user) async {
    dynamic response = await http.post(Uri.parse("http://192.168.0.144/Game/flutter_mobile/mobile_game/php_process/show_favorite.php"), 
      body: {
        'username': user.username
      }
    );

    var favoritedata = json.decode(response.body);

    List<Favorite> list = [];
    
    list = List<Favorite>.from(favoritedata.map((e) => Favorite.fromJson(e)));

    return list;
  }

  Future<int> addFavorite(String username, String helper) async {
    dynamic response = await http.post(Uri.parse("http://192.168.0.144/Game/flutter_mobile/mobile_game/php_process/add_favorite.php"), 
      body: {
        'username': username,
        'helper': helper,
      }
    );

    var addfav = json.decode(response.body);

    int status;
    status = addfav["status"];
    return status;
  }
}