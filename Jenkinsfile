node {
		// Configuration & Checkout
		stage 'Checkout'
		initialConfiguration()
		checkoutRepo(repoUrl)

		// Buid test server
		stage 'Build Test server'
		buidTestServer()
		
		// Code analysis
		//stage 'Code Analysis'
		//codeAnalysis()
		
		// Dependencies
		stage 'Install dependencies.'
		installDependency()

		//Testing
		stage 'Testing'
		testing()
}

def initialConfiguration(){
	workingDir = pwd()
	webrootDir = "d:\\xampp\\htdocs\\jenkinsdemo"
	repoUrl = "https://github.com/shahamitr/crud-app.git"
	seleniumServer = "d:\\xampp\\htdocs\\selenium\\selenium-server-standalone-2.53.0.jar"
	defaultMsg = "Please go to ${env.BUILD_URL} to see reason for failure. \n\n"
	mailList = "amit.shah@infostretch.com"
}

def checkoutRepo(repoUrl){
	try {
		checkout([$class: 'GitSCM', branches: [[name: '*/master']], doGenerateSubmoduleConfigurations: false, extensions: [], submoduleCfg: [], userRemoteConfigs: [[credentialsId: '6f88d131-fc36-4652-89f5-faae3c8ea1a5', url: repoUrl]]])
	} catch (exception) {
		sendMail("Checkout failure", defaultMsg + "${exception}", mailList)
		error "Checkout failed: "${exception}""
	}
}

def buidTestServer(){
	try {
		bat """@echo off
		XCOPY /Y /I /S "${workingDir}" "${webrootDir}" """
		bat """@echo off
		START /MIN java -jar "${seleniumServer}" """
	} catch (exception) {
		sendMail("Building test server failure", defaultMsg + "${exception}", mailList)
		error "Building test server failed: "${exception}""
	}
}

def installDependency(){
	try {
		bat """@echo off
		cd "${webrootDir}"
		d:
		composer install --profile"""
	} catch (exception) {
		sendMail("Installing dependencies failure", defaultMsg + "${exception}", mailList)
		error "Installing dependencies failed: "${exception}""
	}
}

def testing(){
	try {
		bat """@echo off
		cd "${webrootDir}"
		d:
		vendor\\bin\\phpunit tests\\sampleTest.php --log-junit="${workingDir}//phpunit-result.xml" """
		step([$class: 'JUnitResultArchiver', testResults: "phpunit-result.xml"])
	} catch (exception) {
		sendMail("Unit testing failure", defaultMsg + "${exception}", mailList)
		error "Unit testing failed: "${exception}""
	}
}

def codeAnalysis(){
	try {
		bat """@echo off
		cd "${webrootDir}"
		d:
		phpcs --extensions=php --ignore=*/tests/*,*/vendor/*,*/img/*,*/css/* . --report=summary --standard=phpcs.xml -p 
		"""
	} catch (exception) {
		sendMail("Static code analysis failure", defaultMsg + "${exception}", mailList)
		error "Static code analysis failed: "${exception}""
	}
}

def sendMail(subject, body, recipients) {
  mail(to: recipients, subject: "${env.BUILD_TAG} ${subject}", body: body);
}