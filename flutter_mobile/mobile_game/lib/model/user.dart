class User {
  String username;
  String password;
  String credits;
  String contact;
  String email;
  String facebook;
  String profilePic;
  String status;
  String role;

  User(
      {required this.username,
      required this.password,
      required this.credits,
      required this.contact,
      required this.email,
      required this.facebook,
      required this.profilePic,
      required this.status,
      required this.role});

  User.fromJson(Map<String, dynamic> json) 
    :username = json['username'],
    password = json['password'],
    credits = json['credits'],
    contact = json['contact'],
    email = json['email'],
    facebook = json['facebook'],
    profilePic = json['profile_pic'],
    status = json['status'],
    role = json['role'];
  

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['username'] = this.username;
    data['password'] = this.password;
    data['credits'] = this.credits;
    data['contact'] = this.contact;
    data['email'] = this.email;
    data['facebook'] = this.facebook;
    data['profile_pic'] = this.profilePic;
    data['status'] = this.status;
    data['role'] = this.role;
    return data;
  }
}

