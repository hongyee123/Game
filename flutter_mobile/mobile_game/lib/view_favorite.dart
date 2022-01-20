import 'package:flutter/material.dart';
import 'package:mobile_game/controller/favorite_controller.dart';
import 'package:mobile_game/list_favorite.dart';
import 'package:mobile_game/model/favorite.dart';
import 'package:mobile_game/model/user.dart';
import 'package:mobile_game/model/product.dart';
import 'package:mobile_game/model/favorite.dart';
import 'package:mobile_game/NavBar.dart';

class ViewFavorite extends StatefulWidget {
  final User user;
  final Product product;
  const ViewFavorite({ Key? key, required this.user, required this.product}) : super(key: key);

  @override
  _ViewFavoriteState createState() => _ViewFavoriteState();
}

class _ViewFavoriteState extends State<ViewFavorite> {

  FavoriteController favoriteController = new FavoriteController();
  List<Favorite> listFavorite = [];

  @override
  Widget build(BuildContext context) {
    
    return Scaffold(
      drawer: NavBar(user: widget.user, product: widget.product,),
      appBar: AppBar(
        backgroundColor: Colors.black,
        title: Text('Favorite List'),
      ),

      body: FutureBuilder<List<Favorite>>(
        future: favoriteController.fetchFavorite(widget.user),
        builder: (context, snapshot) {
          if (snapshot.hasData) { 
            return ListView.builder(
              itemCount: snapshot.data!.length,
              itemBuilder: (context, index) => ListFavorite(
                user: widget.user,
                favorite: snapshot.data![index],

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