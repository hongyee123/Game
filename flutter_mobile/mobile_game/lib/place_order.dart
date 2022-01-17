import 'package:flutter/material.dart';
import 'package:mobile_game/NavBar.dart';
import 'package:mobile_game/list_place_order.dart';
import 'package:mobile_game/model/cart.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';

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

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      drawer: NavBar(user: widget.user),
      appBar: AppBar(
        backgroundColor: Colors.black,
        title: Text('Place Order'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text("Total: ${widget.subTotalItem}",
              style: TextStyle(
                fontWeight: FontWeight.bold,
                fontSize: 30,
              ),
            ),
            Text("Price: ${widget.subTotalPrice}",
              style: TextStyle(
                fontWeight: FontWeight.bold,
                fontSize: 30,
              ),
            ),
            SizedBox(
              height: 20,
            ),
            Row(
              children: [
                FutureBuilder<List<Cart>>(
                  future:  futureCartList,
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
              ],
            ),
          ],
        ),
      ),
      floatingActionButton: ElevatedButton(
          // onPressed: onPressed, 
          // child: child,
          style: ElevatedButton.styleFrom(
            minimumSize: Size(360, 60),
            primary: Colors.black,
          ), 
          onPressed: () async {
            // var status = await productController.addCart(widget.user.username, widget.product.id, _counter);
            // print("status $status");
            // status == 0
          //   ? Fluttertoast.showToast(
          //     msg : "Add to cart Succssful !",
          //     toastLength: Toast.LENGTH_SHORT,
          //     gravity: ToastGravity.CENTER,
          //     fontSize: 16,
          //   ) : Fluttertoast.showToast(
          //     msg : "Something went wrong",
          //     toastLength: Toast.LENGTH_SHORT,
          //     gravity: ToastGravity.CENTER,
          //     fontSize: 16,
          //   );
          },
          child: Text('Place Order'),
        ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerFloat,
    );
  }
}