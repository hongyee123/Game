import 'package:flutter/material.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';
import 'package:mobile_game/product_detail.dart';

class ListStartOrder extends StatefulWidget {

  final Product product;
  final User user;
  const ListStartOrder({ Key? key, required this.product, required this.user}) : super(key: key);

  @override
  _ListStartOrderState createState() => _ListStartOrderState();
}

class _ListStartOrderState extends State<ListStartOrder> {
  @override
  Widget build(BuildContext context) {
    return Card(
      child:InkWell(
        child:Padding(
          padding: const EdgeInsets.only(top:5, bottom: 20, right: 50, left: 20),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: <Widget>[
              Padding(
                padding: EdgeInsets.only(top:10, bottom: 20),
                child: Text(widget.product.type,
                  style: TextStyle(
                    fontSize: 25,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
              Text(
                widget.product.username,
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                ),
              ),
              Text(
                "RM${widget.product.price} / per game",
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ) ,
        ),
        onTap: (){
          Navigator.push(context, MaterialPageRoute(builder: (context) => DetailPage(product: widget.product, user: widget.user)));
        }
      )
    );
  }
}