import 'package:flutter/material.dart';
import 'package:mobile_game/controller/product_controller.dart';
import 'package:mobile_game/list_start_order.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';

class StartOrder extends StatefulWidget {

  final User user;
  const StartOrder({ Key? key, required this.user}) : super(key: key);

  @override
  _StartOrderState createState() => _StartOrderState();
}

class _StartOrderState extends State<StartOrder> {
  ProductController productController = new ProductController();
  List<Product> listProduct = [];

  @override
  // void initState() {
  //   // TODO: implement initState
  //   productController.fetchProduct(widget.user);
  //   super.initState();
  // }

  @override
  // Widget build(BuildContext context) {
  //   return Scaffold(
  //     appBar: AppBar(
  //       title: Text('Start Order'),
  //     ),
      
  //     body: ListView.builder(
  //       itemCount: listProduct.length,
  //       itemBuilder: (context, index) => ListStartOrder(
  //         product: listProduct[index],
  //       ),
        
  //     )
  //   );
  // }


  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
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