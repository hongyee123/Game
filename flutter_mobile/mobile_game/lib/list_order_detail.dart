import 'package:flutter/material.dart';
import 'package:mobile_game/model/detail.dart';

class ListOrderDetail extends StatefulWidget {

  final Detail detail;
  const ListOrderDetail({ Key? key, required this.detail}) : super(key: key);

  @override
  _ListOrderDetailState createState() => _ListOrderDetailState();
}

class _ListOrderDetailState extends State<ListOrderDetail> {
  @override
  Widget build(BuildContext context) {
    return Card(
      child:InkWell(
        child:Padding(
          padding: const EdgeInsets.only(top:5, bottom: 20, right: 20, left: 20),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Padding(
                    padding: EdgeInsets.only(top:10, bottom: 20),
                    child: Text(widget.detail.ord_type,
                      style: TextStyle(
                        fontSize: 25,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                  Text(
                    widget.detail.ord_helper_id,
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  Text(
                    "RM${widget.detail.ord_price} / per game",
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ],
              ),
              if(widget.detail.ord_status == "1") Text("Pending"),
              if(widget.detail.ord_status == "2") Text("Ing"),
              if(widget.detail.ord_status == "4")  Text("Done"),
              if(widget.detail.ord_status == "3") Row(
                mainAxisAlignment: MainAxisAlignment.end,
                children: [
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.end,
                    children: [
                      Text("Helper had done this order"
                      ),
                      ElevatedButton(
                        child: Text("Confirm"),
                        onPressed: (){},
                      )
                    ],
                  )
                ],
              ),
              
            ],
          )
        ),
        onTap: (){
          // Navigator.push(context, MaterialPageRoute(builder: (context) => DetailPage(product: widget.product, user: widget.user)));
        }
      )
    );
  }
}