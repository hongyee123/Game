import 'package:flutter/material.dart';
import 'package:mobile_game/model/cart.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';

class ListPlaceOrder extends StatefulWidget {

  final Cart cart;
  final User user;
  final Product product;
  const ListPlaceOrder({ Key? key, required this.cart, required this.user, required this.product }) : super(key: key);

  @override
  _ListPlaceOrderState createState() => _ListPlaceOrderState();
}

class _ListPlaceOrderState extends State<ListPlaceOrder> {
  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(top:10),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Expanded(
            flex: 5,
            child: Text(widget.cart.type),
          ),
          Expanded(
            flex: 7,
            child: Text(widget.cart.username),
          ),
          Expanded(
            flex: 3,
            child: Center(child: Text(widget.cart.cart_quantity)),
          ),
          Expanded(
            flex: 5,
            child: Center(child: Text(widget.cart.cart_price)),
          ),
          // Text(widget.cart.type),
          // Text(widget.cart.username),
          // Text(widget.cart.cart_price),
          // Text(widget.cart.cart_quantity),
        ],
      ),
    );
  }
}