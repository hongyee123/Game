import 'package:flutter/material.dart';
import 'package:mobile_game/model/order.dart';

class ListReview extends StatefulWidget {

  final Order order;
  const ListReview({ Key? key, required this.order}) : super(key: key);

  @override
  _ListReviewState createState() => _ListReviewState();
}

class _ListReviewState extends State<ListReview> {
  @override
  Widget build(BuildContext context) {
    return Card(
      child:InkWell(
        child:Padding(
          padding: const EdgeInsets.only(top:32, bottom: 32, right: 16, left: 16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: <Widget>[
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(
                    widget.order.user_id,
                    style: TextStyle(fontWeight: FontWeight.bold),
                  ),
                  Text(
                    widget.order.date,
                  ),
                ],
              ),
              Star(int.parse(widget.order.rate)),
              Text(
                widget.order.comment,
              ),
            ],
          ) ,
        ),
        onTap: (){}
      )
    );
  }

  Widget Star(int rate) {
    if (rate == 1) {
      return Row(
        children: [
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          )
        ],
      );
    }
    else if(rate == 2) {
      return Row(
        children: [
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          ),
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          )
        ],
      );
    }
    else if(rate == 3) {
      return Row(
        children: [
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          ),
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          ),
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          )
        ],
      );
    }
    else if(rate == 4) {
      return Row(
        children: [
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          ),
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          ),
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          ),
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          )
        ],
      );
    }
    else if(rate == 5) {
      return Row(
        children: [
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          ),
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          ),
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          ),
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          ),
          Icon(
            Icons.star,
            color: Colors.yellow,
            size: 25,
          )
        ],
      );
    }
    else {
      return Container();
    }
  }
}