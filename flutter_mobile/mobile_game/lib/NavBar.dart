import 'package:flutter/material.dart';
import 'package:mobile_game/home.dart';
import 'package:mobile_game/start_order.dart';
import 'package:mobile_game/list_cart.dart';
import 'package:mobile_game/login.dart';
import 'model/user.dart';
import 'model/cart.dart';


class NavBar extends StatefulWidget {

  final User user;
  const NavBar({Key? key, required this.user}) : super(key: key);

  @override
  State<NavBar> createState() => _NavBarState();
}

class _NavBarState extends State<NavBar> {
  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: ListView(
        padding: EdgeInsets.zero,
        children: [
          UserAccountsDrawerHeader(
            accountName: Text(widget.user.username),
            accountEmail: Text(widget.user.email),
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
              Navigator.push(context, MaterialPageRoute(builder: (context) => Home(user: widget.user,)));
            },
          ),
          ListTile(
            leading: Icon(Icons.local_mall),
            title: Text('Start Order'),
            onTap: () {
              Navigator.push(context, MaterialPageRoute(builder: (context) => StartOrder(user: widget.user,)));
            },
          ),
          ListTile(
            leading: Icon(Icons.shopping_cart),
            title: Text('Cart'),
            onTap: () {
            },
          ),
          ListTile(
            leading: Icon(Icons.assignment_outlined),
            title: Text('Order Detail'),
            onTap: ()=>null,
          ),
          Divider(),
          ListTile(
            leading: Icon(Icons.favorite),
            title: Text('favorite'),
            onTap: ()=>null,
          ),
          Divider(),
          ListTile(
            leading: Icon(Icons.exit_to_app),
            title: Text('Exit'),
            onTap: (){
              Navigator.push(context,MaterialPageRoute(builder: (context) => Login())); 
            },
          ),
        ],
      ),
    );
  }
}