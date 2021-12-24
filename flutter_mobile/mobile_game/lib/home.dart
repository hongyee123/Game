import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'NavBar.dart';
import 'package:mobile_game/login.dart';

import 'model/user.dart';


class Home extends StatefulWidget {

  final User user;
  const Home({ Key? key, required this.user}) : super(key: key);

  @override
  _HomeState createState() => _HomeState();
}

class _HomeState extends State<Home> {
  

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      drawer: NavBar(user: widget.user),
      appBar: AppBar(
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