using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class InsertData : MonoBehaviour {

    public Text rLogin;
    public Text rPassword;
    public Text rFullname;
    public Text rButton;

    public string inputEmail;
    public string inputPassword;
    public string inputFullname;

    private string createUserURL = "http://studenthome.hku.nl/~just.vanderlinde/Database/db_insert.php";

    private void Update()
    {
        inputEmail = rLogin.text;
        inputPassword = rPassword.text;
        inputFullname = rFullname.text;
    }

    public void Wrapper()
    {
        CreateUser(inputEmail, inputPassword, inputFullname);
        rButton.text = "Registered";
    }

    public void CreateUser(string username, string password, string fullname)
    {

        WWWForm form = new WWWForm();
        form.AddField("emailPost", username);
        form.AddField("passwordPost", password);
        form.AddField("fullnamePost", fullname);

        WWW www = new WWW(createUserURL, form);
    }
}
