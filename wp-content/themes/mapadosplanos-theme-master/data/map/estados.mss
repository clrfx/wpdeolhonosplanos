@green: #7FED0E;
@red: #EDF8E9;

Map {
  background-color: #b8dee6;
}

#countries {
  ::outline {
    line-color: #85c5d3;
    line-width: 2;
    line-join: round;
  }
  polygon-fill: #fff;
}


#estadosl2007 {
  marker-clip:false;
  marker-width:0px;
  line-color:#000;
  line-width:0.1;
  line-opacity:0.7;
  
  [PLANO_ESTA="tem plano"] {
 	polygon-fill:@green;
    
    }
  [PLANO_ESTA!="tem plano"] {
    polygon-fill:@red;
    }
  text-name:[SIGLAUF3];
  text-face-name:"FreeSans Bold";
  text-allow-overlap: true;
}

#estadosl2007 {
  line-color:#594;
  line-width:0.5;
  polygon-opacity:1;
  polygon-fill:#ae8;
}


#estadosl2007 {
  line-color:#594;
  line-width:0.5;
  polygon-opacity:1;
  polygon-fill:#ae8;
}


#estadosl2007 {
  line-color:#594;
  line-width:0.5;
  polygon-opacity:1;
  polygon-fill:#ae8;
}


#estadosl2007 {
  line-color:#594;
  line-width:0.5;
  polygon-opacity:1;
  polygon-fill:#ae8;
}