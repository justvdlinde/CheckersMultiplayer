﻿using System;
using System.Collections.Generic;
using System.IO;
using System.Net;
using System.Net.Sockets;
using UnityEngine;

public class Server : MonoBehaviour {

    public int port = 6321;

    private List<ServerClient> clients;
    private List<ServerClient> disconnectList;

    private TcpListener server;
    private bool serverStarted;

    public void Init() {
        DontDestroyOnLoad(gameObject);
        clients = new List<ServerClient>();
        disconnectList = new List<ServerClient>();

        try {
            server = new TcpListener(IPAddress.Any, port);
            server.Start();
            StartListening();
            serverStarted = true;

        }

        catch(Exception e) {
            Debug.Log("Socket Error: " + e.Message);
        }
    }

    private void Update() {
        if (!serverStarted) {
            return;
        }

        foreach (ServerClient sc in clients) {
            // Is Client Still Connected?
            if(!IsConnected(sc.tcp)) {
                sc.tcp.Close();
                disconnectList.Add(sc);
                continue;
            }
            else {
                NetworkStream s = sc.tcp.GetStream();
                if (s.DataAvailable) {
                    StreamReader reader = new StreamReader(s, true);
                    string data = reader.ReadLine();

                    if(data != null) {
                        OnIncomingData(sc, data);
                    }
                }
            }
        }
        for (int i = 0; i < disconnectList.Count - 1; i++) {

            //Tell Player Someone Has Connected
            clients.Remove(disconnectList[i]);
            disconnectList.RemoveAt(i);
    }
}

    private void StartListening() {
        server.BeginAcceptTcpClient(AcceptTcpClient, server);
    }

    private void AcceptTcpClient(IAsyncResult ar) {
        TcpListener listener = (TcpListener)ar.AsyncState;

        string allUsers = "";
        foreach (ServerClient i in clients) {
            allUsers += i.clientName + '|';
        }

        ServerClient sc = new ServerClient(listener.EndAcceptTcpClient(ar));
        clients.Add(sc);

        StartListening();

        Broadcast("SWHO|" + allUsers, clients[clients.Count - 1]);
    }

    private bool IsConnected(TcpClient c) {
        try {
            if (c != null & c.Client != null && c.Client.Connected) {
                if (c.Client.Poll(0, SelectMode.SelectRead)) {
                    return !(c.Client.Receive(new byte[1], SocketFlags.Peek) == 0);
                }
                return true;
            }
            else {
                return false;
            }
        }
        catch {
            return false;
        }
    }
    //Server Send
    private void Broadcast(string data, List<ServerClient> cl) {
        foreach(ServerClient sc in cl) {
            try {
                StreamWriter writer = new StreamWriter(sc.tcp.GetStream());
                writer.WriteLine(data);
                writer.Flush();
            }
            catch (Exception e){
                Debug.Log("Write Error : " + e.Message); 
            }
        }
    }

    private void Broadcast(string data, ServerClient  c) {
        List<ServerClient> sc = new List<ServerClient> { c };
        Broadcast(data, sc);
    }

    //Server Read
    private void OnIncomingData(ServerClient c, string data) {
        Debug.Log("Server: " + data);
        string[] aData = data.Split('|');

        switch (aData[0]) {
            case "CWHO":
                c.clientName = aData[1];
                c.isHost = (aData[2] == "0" ? false : true);
                Broadcast("SCNN|" + c.clientName, clients);
                break;
            case "CMOV":
                data = data.Replace('C', 'S');
                Broadcast(data, clients);
                break;
        }
    }

}

public class ServerClient {
    public string clientName;
    public TcpClient tcp;
    public bool isHost;

    public ServerClient(TcpClient tcp) {
        this.tcp = tcp;
    }
}
