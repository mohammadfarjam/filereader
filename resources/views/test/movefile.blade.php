<div className="login">
  <h5>ثبت نام</h5>
  <form action="{{ route('register') }}" method="post">
    @csrf
    <span className="line" />
    <p>نام کاربری</p>
    <input className="input" type="text" name="name" defaultValue="{{old('name')}}" placeholder=" نام کاربری " />
    <p>ایمیل</p>
    <input id="email" type="email" className="input" name="email" defaultValue="{{ old('email') }}" required autoComplete="email" placeholder="ایمیل" />
    <p>رمز عبور</p>
    <input className="input" type="password" name="password" defaultValue placeholder="  رمز عبور " />
    <p>تکرار رمز عبور</p>
    <input className="input" type="password" name="password_confirmation" defaultValue placeholder=" تکرار رمز عبور " />
    <button type="submit" className=" btn2 btn btn-success">ثبت نام</button>
  </form>
</div>/*login*/
