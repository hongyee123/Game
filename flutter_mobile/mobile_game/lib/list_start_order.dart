import 'package:flutter/material.dart';
import 'package:mobile_game/model/product.dart';

class ListStartOrder extends StatefulWidget {

  final Product product;
  const ListStartOrder({ Key? key, required this.product}) : super(key: key);

  @override
  _ListStartOrderState createState() => _ListStartOrderState();
}

class _ListStartOrderState extends State<ListStartOrder> {
  @override
  Widget build(BuildContext context) {
    return Card(
            child:Padding(
              padding: const EdgeInsets.only(top:32, bottom: 32, right: 16, left: 16),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Text(
                    widget.product.type,
                    style: TextStyle(
                      fontSize: 22,
                      fontWeight: FontWeight.bold
                    ),
                  ),
                  Text(
                    widget.product.id,
                    
                  ),
                ],
              ) ,
            )
          );
  }
}