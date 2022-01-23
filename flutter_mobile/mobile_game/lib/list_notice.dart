import 'package:flutter/material.dart';
import 'package:mobile_game/model/notice.dart';

class ListNotice extends StatefulWidget {

  final Notice notice;
  const ListNotice({ Key? key, required this.notice}) : super(key: key);

  @override
  _ListNoticeState createState() => _ListNoticeState();
}

class _ListNoticeState extends State<ListNotice> {
  @override
  Widget build(BuildContext context) {
    return SizedBox(
      width: 400,
      height: 10,
      child: Card(
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
                      child: Text(widget.notice.title,
                        style: TextStyle(
                          fontSize: 25,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                    Text(
                      widget.notice.date,
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    Text(
                      widget.notice.contant,
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ],
                ),
              ],
            )
          ),
          onTap: (){
            // Navigator.push(context, MaterialPageRoute(builder: (context) => DetailPage(product: widget.product, user: widget.user)));
          }
        )
      ),
    );
  }
}