import 'dart:async';
import 'dart:convert';
import 'dart:core';
import 'package:flutter/cupertino.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:mobile_game/model/user.dart';
import 'package:mobile_game/home.dart';
import 'package:mobile_game/main.dart';
import 'package:fluttertoast/fluttertoast.dart';


class Login extends StatefulWidget {
  const Login({Key? key}) : super(key: key);

  @override
  _LoginState createState() => _LoginState();
}

class _LoginState extends State<Login> {
  TextEditingController user=new TextEditingController();
  TextEditingController pass=new TextEditingController();

  String msg='';

    _login(BuildContext cont) async {
      dynamic response = await http.post(Uri.parse("http://192.168.0.190/Game/flutter_mobile/mobile_game/php_process/login_function.php"), 
      body: {
        'username': user.text,
        'password': pass.text,
      }
    );
    
    var datauser = json.decode(response.body);
    if(user.text!=''&&pass.text!=''){
      if(datauser.length==0){
        Fluttertoast.showToast(
          msg : "Account Invalid",
          toastLength: Toast.LENGTH_SHORT,
          gravity: ToastGravity.CENTER,
          fontSize: 16,
        );
      }else{
        User u = new User(
          username: datauser[0]['username'], 
          password: datauser[0]['password'], 
          credits: datauser[0]['credits'], 
          contact: datauser[0]['contact'], 
          email: datauser[0]['email'], 
          facebook: datauser[0]['facebook'], 
          profilePic: datauser[0]['profile_pic'] ?? '', 
          status: datauser[0]['status'], 
          role: datauser[0]['role']);
        if(user.text == u.username && pass.text == u.password){
          if(datauser[0]['role']=='1'){
            Navigator.push(cont, MaterialPageRoute(builder: (context) => Home(user: u,))); 
            Fluttertoast.showToast(
              msg : "Hello User",
              toastLength: Toast.LENGTH_SHORT,
              gravity: ToastGravity.CENTER,
              fontSize: 16,
            );
          }else if(datauser[0]['role']=='2'){
            Fluttertoast.showToast(
              msg : "Hello Helper",
              toastLength: Toast.LENGTH_SHORT,
              gravity: ToastGravity.CENTER,
              fontSize: 16,
            );
          }
        }
        
        else{
          Fluttertoast.showToast(
              msg : "Wrong Password",
              toastLength: Toast.LENGTH_SHORT,
              gravity: ToastGravity.CENTER,
              fontSize: 16,
            );
        }
      }
    }else if (user.text==''&&pass.text!=''){
      Fluttertoast.showToast(
        msg : "Please fill in your Username",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.CENTER,
        fontSize: 16,
      );
    }else if (user.text!=''&&pass.text==''){
      Fluttertoast.showToast(
        msg : "Please fill in your Password",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.CENTER,
        fontSize: 16,
      );
    }else{
      Fluttertoast.showToast(
        msg : "Please fill in your Information",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.CENTER,
        fontSize: 16,
      );
    }
  }
  bool isVisible = true;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: true,
      backgroundColor: Colors.black,
      body:Center(
        child: ListView(
          shrinkWrap: true,
          padding: EdgeInsets.all(32),
          children: <Widget>[
            Image.asset(
              'assets/icon.png',
              height: 100,
              width: 100,
            ),
            SizedBox(
              height: 100,
            ),
            TextField(
              controller: user,
              decoration: InputDecoration( 
                filled: true,
                fillColor: Colors.white,
                prefixIcon: Icon(Icons.person),
                suffixIcon: user.text.isEmpty
                ? Text('')
                : GestureDetector(
                onTap: () {
                  user.clear();
                },
                child: Icon(Icons.close)),
                hintText: 'Username',
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.circular(8),
                  borderSide:
                  BorderSide(color: Colors.red, width: 1))),
            ),
            SizedBox(
              height: 16,
            ),
            TextField(
              obscureText: isVisible,
              controller: pass,
              decoration: InputDecoration(
                filled: true,
                fillColor: Colors.white,
                prefixIcon: Icon(Icons.lock),
                suffixIcon: GestureDetector(
                  onTap: () {
                    isVisible = !isVisible;
                    setState(() {});
                  },
                    child: Icon(isVisible ? Icons.visibility : Icons.visibility_off)
                ),
                hintText: 'Password',
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.circular(8),
                  borderSide:
                  BorderSide(color: Colors.red, width: 1)
                )
              ),
            ),
            SizedBox(
              height: 16,
            ),
            ElevatedButton(
              child: Text("Login"),
              onPressed: (){
                _login(context);
              },
            ),
            Text(msg,style: TextStyle(fontSize: 20.0,color: Colors.red),),
          ],
        ),
      )
    );
  }
}