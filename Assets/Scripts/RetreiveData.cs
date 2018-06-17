using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using UnityEngine.UI;

public class RetreiveData : MonoBehaviour {

    public Text lLogin;
    public Text lPassword;
    public Text lButton;

    public string inputEmail;
    public string inputPassword;

    private string loginURL = "http://studenthome.hku.nl/~just.vanderlinde/Database/db_login_unity.php";

    void Update()
    {
        inputEmail = lLogin.text;
        inputPassword = lPassword.text;
    }

    public void Wrapper()
    {
        StartCoroutine(LoginToDB(inputEmail, inputPassword));
        lButton.text = "Logged In";
    }

    private IEnumerator LoginToDB(string email, string password)
    {
        WWWForm form = new WWWForm();
        form.AddField("emailPost", email);
        form.AddField("passwordPost", password);

        WWW www = new WWW(loginURL, form);

        yield return www;

        Debug.Log(www.text);
        if (www.text.Contains("login success")) { 
        Debug.Log("Login Success");
            SceneManager.LoadScene("Menu");
        }
        else lButton.text = "Login Failed";
    }
}
