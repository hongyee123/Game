import 'package:flutter/material.dart';
import 'package:mobile_game/controller/product_controller.dart';
import 'package:mobile_game/list_start_order.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';
import 'package:mobile_game/NavBar.dart';

class StartOrder extends StatefulWidget {

  final User user;
  final Product product;
  const StartOrder({ Key? key, required this.user, required this.product}) : super(key: key);

  @override
  _StartOrderState createState() => _StartOrderState();
}

class _StartOrderState extends State<StartOrder> {
  ProductController productController = new ProductController();
  List<Product> listProduct = [];

  @override

  Widget build(BuildContext context) {
    
    return Scaffold(
      drawer: NavBar(user: widget.user, product: widget.product,),
      appBar: AppBar(
        backgroundColor: Colors.black,
        title: Text('Start Order'),
      ),

      body: FutureBuilder<List<Product>>(
        future: productController.fetchProduct(widget.user),
        builder: (context, snapshot) {
          if (snapshot.hasData) { 
            return ListView.builder(
              itemCount: snapshot.data!.length,
              itemBuilder: (context, index) => ListStartOrder(
                product: snapshot.data![index],
                user: widget.user
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