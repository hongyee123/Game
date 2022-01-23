import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:mobile_game/NavBar.dart';
import 'package:mobile_game/controller/cart_controller.dart';
import 'package:mobile_game/controller/order_controller.dart';
import 'package:mobile_game/home.dart';
import 'package:mobile_game/list_place_order.dart';
import 'package:mobile_game/model/cart.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';
import 'package:mobile_game/order_detail.dart';
import 'package:mobile_game/view_cart.dart';

class PlaceOrder extends StatefulWidget {

  final User user;
  final Product product;
  final int subTotalItem;
  final int subTotalPrice;
  const PlaceOrder({ Key? key, required this.user,required this.product,required this.subTotalItem,required this.subTotalPrice}) : super(key: key);

  @override
  _PlaceOrderState createState() => _PlaceOrderState();
}

class _PlaceOrderState extends State<PlaceOrder> {
  Future<List<Cart>>? futureCartList;

  CartController cartController = new CartController();
  OrderController orderController = new OrderController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      drawer: NavBar(user: widget.user, product: widget.product,),
      appBar: AppBar(
        backgroundColor: Colors.black,
        title: Text('Place Order'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          mainAxisSize: MainAxisSize.max,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Text("Total: ${widget.subTotalItem}",
            //   style: TextStyle(
            //     fontWeight: FontWeight.bold,
            //     fontSize: 30,
            //   ),
            // ),
            // Text("Price: RM${widget.subTotalPrice}",
            //   style: TextStyle(
            //     fontWeight: FontWeight.bold,
            //     fontSize: 30,
            //   ),
            // ),
            // SizedBox(
            //   height: 20,
            // ),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                // Text("Type"),
                // Text("Helper"),
                // Text("Price"),
                // Text("Quantity"),
                Expanded(
                  flex: 5,
                  child: Text(
                    "Type",
                    style: TextStyle(
                      fontWeight: FontWeight.bold
                    ),
                  ),
                ),
                Expanded(
                  flex: 7,
                  child: Text(
                    "Helper",
                    style: TextStyle(
                      fontWeight: FontWeight.bold
                    ),
                  ),
                ),
                Expanded(
                  flex: 3,
                  child: Center(child: Text(
                    "Quantity",
                    style: TextStyle(
                      fontWeight: FontWeight.bold
                    ),
                  )),
                ),
                Expanded(
                  flex: 5,
                  child: Center(child: Text(
                    "Price (RM)",
                    style: TextStyle(
                      fontWeight: FontWeight.bold
                    ),
                  )),
                ),
              ],
            ),
            Expanded(
              child: FutureBuilder<List<Cart>>(
                  future:  cartController.fetchCart(widget.user),
                    builder: (context, snapshot) {
                      if (snapshot.hasData) { 
                        return ListView.builder(
                          itemCount: snapshot.data!.length,
                          itemBuilder: (context, index) => ListPlaceOrder(
                            cart: snapshot.data![index],
                            user: widget.user,
                            product: widget.product,
                          ),
                        );
                      } 
                      if (snapshot.hasError) { print("hehe"); } 
                      return const Center(child: CircularProgressIndicator(),);
                    }
                ),
            ),
            Container(
              child: Column(
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceAround,
                    children: [
                      Text(
                        "Total quantity: ${widget.subTotalItem}",
                        style: TextStyle(
                          fontSize: 17.0,
                          fontWeight: FontWeight.bold
                        ),
                      ),
                      Text(
                        "Total price: ${widget.subTotalPrice}",
                        style: TextStyle(
                          fontSize: 17.0,
                          fontWeight: FontWeight.bold
                        ),
                      ),
                    ],
                  ),
                  SizedBox(
                    height: 15,
                  ),
                  ElevatedButton(
                    // onPressed: onPressed, 
                    // child: child,
                    style: ElevatedButton.styleFrom(
                      minimumSize: Size(360, 60),
                      primary: Colors.black,
                    ), 
                    onPressed: () async {
                      var status = await orderController.placeOrder(widget.user);
                      print("status $status");
                      status == 0
                      ? Fluttertoast.showToast(
                        msg : "Order Placed Succssful !",
                        toastLength: Toast.LENGTH_SHORT,
                        gravity: ToastGravity.CENTER,
                        fontSize: 16,
                      ) : Fluttertoast.showToast(
                        msg : "Something went wrong",
                        toastLength: Toast.LENGTH_SHORT,
                        gravity: ToastGravity.CENTER,
                        fontSize: 16,
                      );

                      await Future.delayed(const Duration(seconds: 2), (){});

                      Navigator.pushAndRemoveUntil(context,MaterialPageRoute(builder: (context) => Home(user: widget.user, product: widget.product,)), ModalRoute.withName("/Logout"));
                      // Navigator.pop(context);
                      // Navigator.pop(context);
                      Navigator.push(context, MaterialPageRoute(builder: (context) => OrderDetail(product: widget.product, user: widget.user)));

                    },
                    child: Text('Place Order'),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
      // floatingActionButton: ElevatedButton(
      //     // onPressed: onPressed, 
      //     // child: child,
      //     style: ElevatedButton.styleFrom(
      //       minimumSize: Size(360, 60),
      //       primary: Colors.black,
      //     ), 
      //     onPressed: () async {
      //       // var status = await productController.addCart(widget.user.username, widget.product.id, _counter);
      //       // print("status $status");
      //       // status == 0
      //     //   ? Fluttertoast.showToast(
      //     //     msg : "Add to cart Succssful !",
      //     //     toastLength: Toast.LENGTH_SHORT,
      //     //     gravity: ToastGravity.CENTER,
      //     //     fontSize: 16,
      //     //   ) : Fluttertoast.showToast(
      //     //     msg : "Something went wrong",
      //     //     toastLength: Toast.LENGTH_SHORT,
      //     //     gravity: ToastGravity.CENTER,
      //     //     fontSize: 16,
      //     //   );
      //     },
      //     child: Text('Place Order'),
      //   ),
      // floatingActionButtonLocation: FloatingActionButtonLocation.centerFloat,
    );
  }
}