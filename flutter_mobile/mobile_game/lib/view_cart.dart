import 'package:flutter/material.dart';
import 'package:mobile_game/controller/product_controller.dart';
import 'package:mobile_game/controller/cart_controller.dart';
import 'package:mobile_game/list_start_order.dart';
import 'package:mobile_game/list_cart.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/user.dart';
import 'package:mobile_game/model/cart.dart';
import 'package:mobile_game/NavBar.dart';

class ViewCart extends StatefulWidget {
  final User user;
  final Product product;
  const ViewCart({ Key? key, required this.user,required this.product}) : super(key: key);

  @override
  _ViewCartState createState() => _ViewCartState();
}
  CartController cartController = new CartController();

class _ViewCartState extends State<ViewCart> {

  Future<List<Cart>>? futureCartList;
  int SubTotalItem = 0;
  int SubTotalPrice = 0;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    getCartData();
    getCartPrice();

  }

  Future<void> getCartData() async {
    List<Cart> cartData = await cartController.fetchCart(widget.user);

    setState(() {
      futureCartList = Future.value(cartData);
    });

    for(int i=0; i < cartData.length; i++){
      SubTotalItem += int.parse(cartData[i].cart_quantity);
    }

    print('Item : ${SubTotalItem}');
  }



  Future<void> getCartPrice() async {
    List<Cart> cartData = await cartController.fetchCart(widget.user);

    setState(() {
      futureCartList = Future.value(cartData);
    });

    for(int i=0; i < cartData.length; i++){
      SubTotalPrice += int.parse(cartData[i].cart_quantity)*int.parse(widget.product.price);
    }

    print('Price : ${SubTotalPrice}');
  }



  @override
  Widget build(BuildContext context) {
    return Scaffold(
      drawer: NavBar(user: widget.user),
      appBar: AppBar(
        backgroundColor: Colors.black,
        title: Text('View Cart'),
      ),
      body: FutureBuilder<List<Cart>>(
        future:  futureCartList,
        builder: (context, snapshot) {
          if (snapshot.hasData) { 
            return ListView.builder(
              itemCount: snapshot.data!.length,
              itemBuilder: (context, index) => ListCart(
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
          child: Text('Check Out'),
        ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerFloat,
    );
  }
}