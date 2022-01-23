import 'package:flutter/material.dart';
import 'package:mobile_game/controller/product_controller.dart';
import 'package:mobile_game/controller/order_controller.dart';
import 'package:mobile_game/list_review.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/order.dart';
import 'package:mobile_game/list_start_order.dart';
import 'package:mobile_game/list_cart.dart';
import 'package:mobile_game/NavBar.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:mobile_game/model/user.dart';
import 'package:mobile_game/view_cart.dart';


class DetailPage extends StatefulWidget {
  final Product product;
  final User user;
  const DetailPage({ Key? key, required this.product, required this.user}) : super(key: key);

  

  @override
  _DetailPageState createState() => _DetailPageState();
}

class _DetailPageState extends State<DetailPage> {

  int _counter = 1;
  bool _flag = true;

  ProductController productController = new ProductController();
  OrderController orderController = new OrderController();

  void _incrementCounter() {
    var quantity = int.parse(widget.product.quantity);
    if(_counter<quantity){
      setState(() {
        _counter++;
      });
    }else{
      Fluttertoast.showToast(
        msg : "Quantity no enough",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.CENTER,
        fontSize: 16,
      );
    }
  }
  void _decrementCounter() {
    if(_counter>1){
      setState(() {
        _counter--;
      });
    }else{
      Fluttertoast.showToast(
        msg : "Quantity cant samll than 1",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.CENTER,
        fontSize: 16,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.black,
        title: Text('Product Detail'),
        actions: [
          IconButton(
            icon: Icon(Icons.favorite),
            onPressed: () {},
          ),
          IconButton(
            icon: Icon(Icons.shopping_cart),
            onPressed: () {
              Navigator.push(context, MaterialPageRoute(builder: (context) => ViewCart(user: widget.user,product:widget.product)));
            },
          ),
        ],
      ),
      backgroundColor: Colors.black,
      body: SafeArea(
        
        child: Column(
          children: <Widget>[
            Card(
              child: Padding(
              padding: const EdgeInsets.all(16.0),
                child: Column(
                  children: [
                    Row(children: [
                      Text(widget.product.type,
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 30,
                        ),
                      ),
                      
                    ],),
                    Row(
                      children: [
                        Text("Quantity left: ${widget.product.quantity}",
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 16,
                            color: Colors.green,
                          ),
                        ),
                      ],
                    ),

                    SizedBox(
                      height: 20,
                    ),

                    Row(
                      children: [
                        Text("Price : RM ${widget.product.price}/game",
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 16,
                          ),
                        ),
                      ],
                    ),

                    Row(children: [
                      Text("Quantity  "),
                        MaterialButton( 
                          height: 20.0, 
                          minWidth: 5.0, 
                          color: Colors.black, 
                          textColor: Colors.white, 
                          child: new Text("-"), 
                          onPressed: _decrementCounter,
                        ),
                      Text("   "'$_counter'"   ",
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 18,
                        ),
                      ),
                      MaterialButton( 
                        height: 20.0, 
                        minWidth: 5.0, 
                        color: Colors.black, 
                        textColor: Colors.white, 
                        child: new Text("+"), 
                        onPressed: _incrementCounter,
                      ),
                    ],)
                  ],
                ),
              )
            ),
            Card(
              child: ListTile(
                title: Text("Description",
                  style: TextStyle(
                    fontWeight: FontWeight.bold,
                    fontSize: 18,
                  ),
                ),
                subtitle: Text(widget.product.description),
              ),
            ),
            Container(
              alignment: Alignment.centerLeft,
              padding: EdgeInsets. only(top:20.0,left: 10,right: 10),
              child: Text("Review",
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 18,
                  color: Colors.white,
                ),
              ),
            ),
            Expanded(
              child: FutureBuilder<List<Order>>(
                  future: orderController.fetchOrder(widget.product),
                  builder: (context, snapshot) {
                    if (snapshot.hasData) { 
                      return ListView.builder(
                        itemCount: snapshot.data!.length,
                        itemBuilder: (context, index) => ListReview(
                          order: snapshot.data![index],
                        ),
                      );
                    } 
                    if (snapshot.hasError) { print("hehe"); } 
                    return const Center(child: CircularProgressIndicator(),);
                  }
                ),
            ),
            Container(
              alignment: Alignment.center,
              padding: EdgeInsets.only(top: 20.0, bottom: 20),
              child: ElevatedButton(
                // onPressed: onPressed, 
                // child: child,
                style: ElevatedButton.styleFrom(
                  minimumSize: Size(360, 60),
                  primary: Colors.red,
                ), 
                onPressed: () async {
                  var status = await productController.addCart(widget.user.username, widget.product.id, _counter);
                  print("status $status");

                  if(status==0){
                    Fluttertoast.showToast(
                    msg : "Add to cart Succssful !",
                    toastLength: Toast.LENGTH_SHORT,
                    gravity: ToastGravity.CENTER,
                    fontSize: 16);
                  }else if(status==1){
                    Fluttertoast.showToast(
                    msg : "Quantity in Your Cart is more the Quantity left",
                    toastLength: Toast.LENGTH_SHORT,
                    gravity: ToastGravity.CENTER,
                    fontSize: 16);

                  }else{
                    Fluttertoast.showToast(
                    msg : "Something went wrong",
                    toastLength: Toast.LENGTH_SHORT,
                    gravity: ToastGravity.CENTER,
                    fontSize: 16,);
                  }
                },
                child: Text('Add to Cart'),
              )
            )
          ],
        ),
      )
    );
  }
}