<?php
$questions = array('FTP','AJAX','RSS','XSS','PHP','W3C','XML','YUI','HTML','CGI','SSL','SQL','HTTP','CSS','SOAP','WAI','SSI','JSON','XSLT','WCAG');
$answers = array(
array(0 =>'File Transfer Protocol','Force Through Privately','File Through Protocol','File Test Protocol'),
array(0 => 'Asynchronous JavaScript and XML','All JavaScript and XML','Alternative Java and XML','Actual JavaScript and XML'),
array(0 => 'Really Simple Syndication','Really Simple Scripting','Ready-Styled Scripting','Really Stupid Syndication'),
array(0 => 'Cross-site Scripting','Cross-site Security','Cleverly Structured Scripting','eXtremely Safe and Secure'),
array(0 => 'PHP: Hypertext Preprocessor','Post Hypertext Processor','Practical HTML Processing','Process HTML Prettily'),
array(0 => 'World Wide Web Consortium','World Wide Web Committee','World Wide Web Creatives','Wakefield Willy Wavers Club'),
array(0 => 'eXtensible Markup Language','eXtendable Markup Language','Crossover Markup Language','eXtreme Markup Language'),
array(0 => 'Yahoo User Interface','Yahoo\'s Useful Idea','Yahoo Utility Interface','Yahoo User Interaction'),
array(0 => 'Hypertext Markup Language','Human Markup Language','Helpful Markup Language','Hypertext Memory Language'),
array(0 => 'Common Gateway Interface','Common or Garden Interaction','Computer\'s Graphical Intelligence','Common Graphical Interface'),
array(0 => 'Secure Sockets Layer','Server Security Layer','Server Security Level','Secret Socket Layer'),
array(0 => 'Structured Query Language','Stupid Query Language','Secure Query Language','Strict Query Language'),
array(0 => 'Hypertext Transfer Protocol','Hypertext Traffic Protocol','HTML Traffic Transfer Protocol','HTML Through Traffic Protocol'),
array(0 => 'Cascading Style Sheets','Custom Style Sheets','Clientside Style Sheets','Calculated Style Sheets'),
array(0 => 'Simple Object Access Protocol','Structured Object Access Protocol','Simple, Objective And Private','Simply Obvious Access Principle'),
array(0 => 'Web Accessibility Initiative','World Wide Accessibility Intiative','World Wide Accessibility Incorporation','Web Accessibility and Inclusion'),
array(0 => 'Server-Side Include','Server-Side Intelligence','Scripted Server Include','Secure Server Include'),
array(0 => 'JavaScript Object Notation','JQuery-Scripting Object Notation','Just Simple Object Notation','JavaScript Over the Net'),
array(0 => 'eXtensible Stylesheet Language Transformation','eXpandable Stylesheet Language Transfer','eXtensible Stylesheet Language Transfer','eXtendable Stylesheet Language Transformation'),
array(0 => 'Web Content Accessibility Guidelines','Wakefield Community Action Group','Web Criteria And Guidelines','World-wide Common Access Group')
);
function shuffle_assoc(&$array) {
      $keys = array_rand($array, count($array));
	  foreach($keys as $key)
        $new[$key] = $array[$key];
	  $array = $new;
      return true;
  } 
?>
