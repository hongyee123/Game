import 'package:flutter/material.dart';
import 'package:mobile_game/model/cart.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';

class ListPlaceOrder extends StatefulWidget {

  final User user;
  final Cart cart;
  final Product product;
  const ListPlaceOrder({ Key? key, required this.user, required this.cart, required this.product }) : super(key: key);

  @override
  _ListPlaceOrderState createState() => _ListPlaceOrderState();
}

class _ListPlaceOrderState extends State<ListPlaceOrder> {
  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(top:5, bottom: 20, right: 20, left: 20),
      child: Column(
        children: <Widget>[
          Text(widget.product.type),
          Text(widget.product.username),
          Text(widget.product.price),
          Text(widget.product.quantity),
        ]
      )
    );
  }
}