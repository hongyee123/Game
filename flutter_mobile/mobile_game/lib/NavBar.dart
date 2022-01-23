import 'package:flutter/material.dart';
import 'package:mobile_game/controller/product_controller.dart';
import 'package:mobile_game/home.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/order_detail.dart';
import 'package:mobile_game/start_order.dart';
import 'package:mobile_game/list_cart.dart';
import 'package:mobile_game/login.dart';
import 'package:mobile_game/view_cart.dart';
import 'package:mobile_game/view_favorite.dart';
import 'model/user.dart';
import 'model/cart.dart';


class NavBar extends StatefulWidget {

  final User user;
  final Product product;
  const NavBar({Key? key, required this.user, required this.product}) : super(key: key);

  @override
  State<NavBar> createState() => _NavBarState();
}

class _NavBarState extends State<NavBar> {

  ProductController productController = new ProductController();
  List<Product> list = [];

  @override
  void initState() {
    // TODO: implement initState
    productController.fetchProduct(widget.user);
    super.initState();
  }
  
  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: ListView(
        padding: EdgeInsets.zero,
        children: [
          UserAccountsDrawerHeader(
            accountName: Text(widget.user.username),
            accountEmail: Text("RM "+widget.user.credits),
            currentAccountPicture: CircleAvatar(
              child: ClipOval(
                child: Image.network(
                  'http://192.168.0.190/Game/${widget.user.profilePic}',
                  width: 90,
                  height: 90,
                  fit: BoxFit.cover,
                ),
              ),
            ),
            decoration: BoxDecoration(
                color: Colors.black,
                image:DecorationImage(
                  image:NetworkImage(
                    'https://media.istockphoto.com/photos/abstract-background-wallpaper-picture-id952039286?b=1&k=20&m=952039286&s=170667a&w=0&h=LmOcMt7FHxFUAr2bOSfTUPV9sQhME6ABtAYLM0cMkR4=',
                  ),
                  fit: BoxFit.cover,
                )
            ),
          ),
          ListTile(
            leading: Icon(Icons.home),
            title: Text('Home'),
            onTap: () {
              Navigator.push(context, MaterialPageRoute(builder: (context) => Home(user: widget.user, product: widget.product,)));
            },
          ),
          ListTile(
            leading: Icon(Icons.local_mall),
            title: Text('Start Order'),
            onTap: () {
              Navigator.push(context, MaterialPageRoute(builder: (context) => StartOrder(user: widget.user, product: widget.product)));
            },
          ),
          ListTile(
            leading: Icon(Icons.shopping_cart),
            title: Text('Cart'),
            onTap: () {
              Navigator.push(context, MaterialPageRoute(builder: (context) => ViewCart(user: widget.user, product: widget.product)));
            },
          ),
          ListTile(
            leading: Icon(Icons.assignment_outlined),
            title: Text('Order Detail'),
            onTap: () {
              Navigator.push(context, MaterialPageRoute(builder: (context) => OrderDetail(user: widget.user, product: widget.product,)));
            },
          ),
          Divider(),
          ListTile(
            leading: Icon(Icons.favorite),
            title: Text('favorite'),
            onTap: () {
              Navigator.push(context, MaterialPageRoute(builder: (context) => ViewFavorite(user: widget.user, product: widget.product,)));
            },
          ),
          Divider(),
          ListTile(
            leading: Icon(Icons.exit_to_app),
            title: Text('Exit'),
            onTap: (){
              Navigator.pushAndRemoveUntil(context,MaterialPageRoute(builder: (context) => Login()), ModalRoute.withName("/Logout")); 
            },
          ),
        ],
      ),
    );
  }
}