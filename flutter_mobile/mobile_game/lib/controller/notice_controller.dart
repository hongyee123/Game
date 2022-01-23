import 'dart:convert';
import 'dart:developer';
import 'package:http/http.dart' as http;
import 'package:mobile_game/model/notice.dart';

class NoticeController {
  Future<List<Notice>> fetchNotice() async {
    dynamic response = await http.post(Uri.parse("http://192.168.0.190/Game/flutter_mobile/mobile_game/php_process/show_notice.php"), 
      // body: {
      //   'username': user.username
      // }
    );

    var noticedata = json.decode(response.body);

    List<Notice> list = [];
    
    list = List<Notice>.from(noticedata.map((e) => Notice.fromJson(e)));
    inspect(noticedata);

    return list;
  }
}