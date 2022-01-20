import 'package:flutter/material.dart';
import 'package:mobile_game/NavBar.dart';
import 'package:mobile_game/controller/order_controller.dart';
import 'package:mobile_game/list_order_detail.dart';
import 'package:mobile_game/model/detail.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';

class OrderDetail extends StatefulWidget {
  
  final User user;
  final Product product;
  const OrderDetail({ Key? key, required this.user, required this.product}) : super(key: key);

  @override
  _OrderDetailState createState() => _OrderDetailState();
}

class _OrderDetailState extends State<OrderDetail> {

  OrderController orderController = new OrderController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      drawer: NavBar(user: widget.user, product: widget.product,),
      appBar: AppBar(
        backgroundColor: Colors.black,
        title: Text('Order Detail'),
      ),

      body: FutureBuilder<List<Detail>>(
        future: orderController.fetchOrderDetail(widget.user),
        builder: (context, snapshot) {
          if (snapshot.hasData) { 
            return ListView.builder(
              itemCount: snapshot.data!.length,
              itemBuilder: (context, index) => ListOrderDetail(
                detail: snapshot.data![index]
              ),
            );
          } 
          if (snapshot.hasError) { print("hehe"); } 
          return const Center(child: CircularProgressIndicator(),);
        }
      )
    );
  }
}