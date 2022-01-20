import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:mobile_game/model/product.dart';
import 'NavBar.dart';
import 'package:mobile_game/login.dart';

import 'model/user.dart';


class Home extends StatefulWidget {

  final User user;
  final Product product;
  const Home({ Key? key, required this.user, required this.product}) : super(key: key);

  @override
  _HomeState createState() => _HomeState();
}

class _HomeState extends State<Home> {
  

  @override
  Widget build(BuildContext context) {
    SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle(
      statusBarColor: Colors.black
    ));
    return Scaffold(
      drawer: NavBar(user: widget.user, product: widget.product),
      appBar: AppBar(
        backgroundColor: Colors.black,
        title: Text('Home'),
      ),
      body: Container(
        child: 
        SizedBox(
              height: 100,
            ),
      ),
    );
  }
}