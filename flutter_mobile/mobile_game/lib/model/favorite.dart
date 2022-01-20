class Favorite {
  String favorite_user;
  String favorite_helper;
  

  Favorite(
      {required this.favorite_user,
      required this.favorite_helper
      });

  Favorite.fromJson(Map<String, dynamic> json) 
    :favorite_user = json['favourite_user'],
    favorite_helper = json['favourite_helper'];
  

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['favourite_user'] = this.favorite_user;
    data['favourite_helper'] = this.favorite_helper;
    
    return data;
  }
}
