/*
MySQL Data Transfer
Source Host: 192.168.168.120
Source Database: tekencallback
Target Host: 192.168.168.120
Target Database: tekencallback
Date: 10/03/2023 13:31:10
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for callback
-- ----------------------------
CREATE TABLE `callback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `json` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `callback` VALUES ('1', '{\r\n\"status\": true,\r\n\"code\": \"REGISTRATION_COMPLETE\",\r\n\"timestamp\": \"2021-09-20T16:43:51+07:00\",\r\n\"message\": null,\r\n\"data\": {\r\n\"email\": \"ayu@mail.com\"\r\n}\r\n}\r\n');
INSERT INTO `callback` VALUES ('2', '{\r\n\"status\": true,\r\n\"code\": \"REGISTRATION_COMPLETE\",\r\n\"timestamp\": \"2021-09-20T16:43:51+07:00\",\r\n\"message\": null,\r\n\"data\": {\r\n\"email\": \"ayu@mail.com\"\r\n}\r\n}\r\n');
INSERT INTO `callback` VALUES ('3', '{\r\n\"status\": true,\r\n\"code\": \"REGISTRATION_COMPLETE\",\r\n\"timestamp\": \"2021-09-20T16:43:51+07:00\",\r\n\"message\": null,\r\n\"data\": {\r\n\"email\": \"ayu@mail.com\"\r\n}\r\n}\r\n');
INSERT INTO `callback` VALUES ('4', '');
INSERT INTO `callback` VALUES ('5', '{\r\n\"status\": true,\r\n\"code\": \"REGISTRATION_COMPLETE\",\r\n\"timestamp\": \"2021-09-20T16:43:51+07:00\",\r\n\"message\": null,\r\n\"data\": {\r\n\"email\": \"ayu@mail.com\"\r\n}\r\n}');
INSERT INTO `callback` VALUES ('6', '{\r\n\"status\": true,\r\n\"code\": \"REGISTRATION_COMPLETE\",\r\n\"timestamp\": \"2021-09-20T16:43:51+07:00\",\r\n\"message\": null,\r\n\"data\": {\r\n\"email\": \"ayu@mail.com\"\r\n}\r\n}');
INSERT INTO `callback` VALUES ('7', '');
INSERT INTO `callback` VALUES ('8', '');
INSERT INTO `callback` VALUES ('9', '{\r\n\"status\": true,\r\n\"code\": \"REGISTRATION_COMPLETE\",\r\n\"timestamp\": \"2021-09-20T16:43:51+07:00\",\r\n\"message\": null,\r\n\"data\": {\r\n\"email\": \"ayu@mail.com\"\r\n}\r\n}\r\n');
INSERT INTO `callback` VALUES ('10', '{\"query\":\"\n    query IntrospectionQuery {\n      __schema {\n        queryType { name }\n        mutationType { name }\n        subscriptionType { name }\n        types {\n          ...FullType\n        }\n        directives {\n          name\n          description\n          locations\n          args {\n            ...InputValue\n          }\n        }\n      }\n    }\n\n    fragment FullType on __Type {\n      kind\n      name\n      description\n      fields(includeDeprecated: true) {\n        name\n        description\n        args {\n          ...InputValue\n        }\n        type {\n          ...TypeRef\n        }\n        isDeprecated\n        deprecationReason\n      }\n      inputFields {\n        ...InputValue\n      }\n      interfaces {\n        ...TypeRef\n      }\n      enumValues(includeDeprecated: true) {\n        name\n        description\n        isDeprecated\n        deprecationReason\n      }\n      possibleTypes {\n        ...TypeRef\n      }\n    }\n\n    fragment InputValue on __InputValue {\n      name\n      description\n      type { ...TypeRef }\n      defaultValue\n    }\n\n    fragment TypeRef on __Type {\n      kind\n      name\n      ofType {\n        kind\n        name\n        ofType {\n          kind\n          name\n          ofType {\n            kind\n            name\n            ofType {\n              kind\n              name\n              ofType {\n                kind\n                name\n                ofType {\n                  kind\n                  name\n                  ofType {\n                    kind\n                    name\n                  }\n                }\n              }\n            }\n          }\n        }\n      }\n    }\n  \"}');
