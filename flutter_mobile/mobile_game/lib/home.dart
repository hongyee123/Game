import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:mobile_game/controller/notice_controller.dart';
import 'package:mobile_game/list_notice.dart';
import 'package:mobile_game/model/notice.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/start_order.dart';
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
  
  NoticeController noticeController = new NoticeController();

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
        color: Colors.black,
        child: 
        Column(
          children: [
            SizedBox(
              height: 180,
            ),
            Padding(
              padding:
                  EdgeInsets.fromLTRB(10 , 0 , 10, 10),
              child: Text(
                "Game Levelling Helper Finding System",
                style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold,color: Colors.white),
              ),
            ),
            ElevatedButton(
          style: ElevatedButton.styleFrom(
            minimumSize: Size(150, 40),
            primary: Colors.red,
          ), 
          onPressed: () async {
            Navigator.push(context, MaterialPageRoute(builder: (context) => StartOrder(user: widget.user, product:widget.product)));
          },
          child: Text('Start Order'),
        ),
            SizedBox(
              height: 100,
            ),
            SizedBox(height: 10),
            Expanded(
              child: FutureBuilder<List<Notice>>(
                future: noticeController.fetchNotice(),
                builder: (context, snapshot) {
                  if (snapshot.hasData) { 
                    return ListView.builder(
                      scrollDirection: Axis.horizontal,
                      itemCount: snapshot.data!.length,
                      itemBuilder: (context, index) => ListNotice(
                        notice: snapshot.data![index]
                      ),
                    );
                  } 
                  if (snapshot.hasError) { print("hehe"); } 
                  return const Center(child: CircularProgressIndicator(),);
                }
              )
            )
          ],
        )
      ),
    );
  }
}