package help.me.boot.beans;


import java.io.File;
import java.io.IOException;

import org.apache.catalina.connector.Connector;
import org.apache.coyote.http11.Http11NioProtocol;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.context.embedded.EmbeddedServletContainerFactory;
import org.springframework.boot.context.embedded.tomcat.TomcatEmbeddedServletContainerFactory;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.core.io.ClassPathResource;

/**
 * Creates the embedded tomcat server.  Can set up the ssl connector in the future.
 * 
 * @author triviski
 *
 */
@Configuration
public class EmbeddedServerConfiguration {
	
	
	/**
	 * @return tomcat servlet container.
	 */
	@Bean
	@Autowired
	public EmbeddedServletContainerFactory embeddedServletContainerFactory() {
		
	    TomcatEmbeddedServletContainerFactory tomcat = new TomcatEmbeddedServletContainerFactory();
	    
	    /**
	     * This is not currently being used but leaving this in.  This would be how we can 
	     * configure an ssl (HTTPS) connector.
	     */
	    //tomcat.addAdditionalTomcatConnectors(createSslConnector());
	    return tomcat;
	}
	
	/**
	 * Used to create a secure connector.  Not being used.
	 * @return Configured ssl connector.
	 */
	protected Connector createSslConnector() {
	    Connector connector = new Connector("org.apache.coyote.http11.Http11NioProtocol");
	    Http11NioProtocol protocol = (Http11NioProtocol) connector.getProtocolHandler();
	    try {
	        File keystore = new ClassPathResource("keystore").getFile();
	        File truststore = new ClassPathResource("keystore").getFile();
	        connector.setScheme("https");
	        connector.setSecure(true);
	        connector.setPort(8443);
	        protocol.setSSLEnabled(true);
	        protocol.setKeystoreFile(keystore.getAbsolutePath());
	        protocol.setKeystorePass("changeit");
	        protocol.setTruststoreFile(truststore.getAbsolutePath());
	        protocol.setTruststorePass("changeit");
	        protocol.setKeyAlias("apitester");
	        return connector;
	    }
	    catch (IOException ex) {
	        throw new IllegalStateException("can't access keystore: [" + "keystore"
	                + "] or truststore: [" + "keystore" + "]", ex);
	    }
	}
}
