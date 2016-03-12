package help.me.boot;

import java.io.File;
import java.io.IOException;
import java.io.InputStream;

import org.springframework.context.event.ContextRefreshedEvent;
import org.springframework.context.event.EventListener;
import org.springframework.stereotype.Component;

import help.me.orm.bo.IServiceBo;

/**
 * Once spring says the application context is ready this will fire.  Checks for a system property with the 
 * service description/icon file pairs.  If found will get the serviceBo and initialized the database with 
 * the data from the file.  
 * 
 * @author triviski
 *
 */
@Component
public class ServiceInitListener {
	public static final String SERVICE_INIT_FILE_PROPERTY = "help.me.serviceInitFile";
    public static final String SERVICE_BO_NAME = "serviceBo";
    public static final String INIT_DEFAULT_FILE = "classpath:/img/service_init.csv";
	/**
	 * When the context is ready will init the service db from the init file if given. Any updates to the file 
	 * will be found and the data will be updated in the hibernate database.
	 * 
	 * @param ctx
	 */
	@EventListener
	public void handleApplicationReady(ContextRefreshedEvent ctx) {
		String initFile = System.getProperty(SERVICE_INIT_FILE_PROPERTY);
	    initFile = initFile == null ? INIT_DEFAULT_FILE : initFile;
	    
         try {
     		IServiceBo serviceBo = (IServiceBo) ctx.getApplicationContext().getBean(SERVICE_BO_NAME);
     		if (initFile.startsWith("classpath:")) {
     			InputStream initStream = getClass().getResourceAsStream(initFile.replace("classpath:", ""));
     			serviceBo.initializeFromStream(initStream);
     		} else {
     			serviceBo.initializeFromFile(new File(initFile));
     		}
		} catch (IOException e) {
			e.printStackTrace();
		}
    } 
}
