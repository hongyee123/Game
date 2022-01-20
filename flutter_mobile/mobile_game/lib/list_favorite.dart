import 'package:flutter/material.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/favorite.dart';
import 'package:mobile_game/model/user.dart';
import 'package:mobile_game/controller/favorite_controller.dart';
import 'package:mobile_game/product_detail.dart';
import 'package:fluttertoast/fluttertoast.dart';




class ListFavorite extends StatefulWidget {
  final User user;
  final Favorite favorite;
  const ListFavorite({ Key? key,  required this.user,  required this.favorite}) : super(key: key);


  @override
  _ListFavoriteState createState() => _ListFavoriteState();
}
bool _flag = false;

FavoriteController favoriteController = new FavoriteController();


class _ListFavoriteState extends State<ListFavorite> {

  @override
  void initState() {
    // TODO: implement initState
    _flag = false;
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Card(
      child:InkWell(
        child:Padding(
          padding: const EdgeInsets.only(top:5, bottom: 20, right: 50, left: 20),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: <Widget>[
              Padding(
                padding: EdgeInsets.only(top:10, bottom: 20),
                child: Text(widget.favorite.favorite_helper,
                  style: TextStyle(
                    fontSize: 25,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
              ElevatedButton(
                onPressed: () async {
                  var status = await  favoriteController.addFavorite(widget.favorite.favorite_user, widget.favorite.favorite_helper);

                  print("status $status");

                  if(status==0){
                    setState(() {
                      _flag = false;
                    });
                    Fluttertoast.showToast(
                    msg : "Add to cart Succssful !",
                    toastLength: Toast.LENGTH_SHORT,
                    gravity: ToastGravity.CENTER,
                    fontSize: 16);
                  }if(status==2){
                    setState(() {
                      _flag = true;
                    });
                    Fluttertoast.showToast(
                    msg : "Remove Succssful !",
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
                child: Text(_flag ? 'Add to Favorite' : 'Remove from Favorite'),
                style: ElevatedButton.styleFrom(
                  primary: _flag ? Colors.blue : Colors.red,
                )
              ),
            ],
          ) ,
        ),
        onTap: (){
          // Navigator.push(context, MaterialPageRoute(builder: (context) => DetailPage(product: widget.product, user: widget.user)));
        }
      )
    );
  }
}







// onPressed: () => setState(() => _flag = !_flag),
//   child: Text(_flag ? 'Green' : 'Red'),
//   style: ElevatedButton.styleFrom(
//     primary: _flag ? Colors.teal : Colors.red, // This is what you need!
// ),