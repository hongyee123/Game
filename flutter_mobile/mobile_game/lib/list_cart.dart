import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';
import 'package:mobile_game/model/cart.dart';
import 'package:mobile_game/product_detail.dart';

class ListCart extends StatefulWidget {

  final User user;
  final Cart cart;
  final Product product;
  const ListCart({ Key? key, required this.user, required this.cart, required this.product}) : super(key: key);

  @override
  _ListCartState createState() => _ListCartState();
}

class _ListCartState extends State<ListCart> {
  @override
  Widget build(BuildContext context) {
    return Card(
      child:InkWell(
        child:Padding(
          padding: const EdgeInsets.only(top:5, bottom: 20, right: 20, left: 20),
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
                "Helper    : RM${widget.product.username}",
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                ),
              ),
              Text(
                "Price       : RM${widget.product.price} / per game",
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                ),
              ),
              Text(
                "Quantity : ${widget.cart.cart_quantity}",
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ) ,
        ),
      )
    );
  }
}

