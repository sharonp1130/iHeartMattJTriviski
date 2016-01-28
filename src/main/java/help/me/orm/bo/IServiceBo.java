package help.me.orm.bo;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.Collection;

import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVParser;
import org.apache.commons.csv.CSVRecord;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.entity.Service;

public interface IServiceBo extends IBo<Service> {
	public static final String DESC_HEADER_NAME = "description";
	public static final String ICON_HEADER_NAME = "icon";
	
	
	/**
	 * Finds the service with description.  
	 * @param description
	 * @return Service object null if found
	 */
	public Service getServiceWithDescription(String description);

	/**
	 * Get a collection of all of the valid service descriptions.
	 * 
	 * @return
	 */
	public Collection<String> getServiceDescriptions();
	
	/**
	 * Takes the init file csv row and will check if the service already exists.  If it does not 
	 * will create a new one and save it.
	 * 
	 * @param csv
	 */
	public default void checkAndAddIfNeccessary(CSVRecord csv) {
		if (!csv.isConsistent()) {
			log.error("Service init file row is iconsistent with expected format: " + csv.getRecordNumber());
		} else {
			String description = csv.get(DESC_HEADER_NAME);
			String fname = csv.get(ICON_HEADER_NAME);
			
			Service service = getServiceWithDescription(description);
			
			if (service == null) {
				// Need to add a new service.
				service = new Service();
			}
			
			service.setDescription(description);
			service.setIconFileName(fname);
			
			getDao().saveOrUpdate(service);
			
		}
	}
	
	/**
	 * Since this set of data should change rarely we initialize from a file 
	 * to make sure all is set up...balls.  
	 * 
	 * The file is expected to just be a csv.  On each line is description,icon file path.
	 * The path should be relative to the working dir at least...not sure how to do this
	 * for production yet...
	 * TODO fix path situation.
	 * 
	 * @param initFile
	 * @return 
	 * @throws IOException 
	 * @throws FileNotFoundException 
	 */
	@Transactional
	public default void initializeFromFile(File initFile) throws FileNotFoundException, IOException {
		initializeFromStream(new FileInputStream(initFile));
	}
	
	/**
	 * Since this set of data should change rarely we initialize from a file 
	 * to make sure all is set up...balls.  
	 * 
	 * The file is expected to just be a csv.  On each line is description,icon file path.
	 * The path should be relative to the working dir at least...not sure how to do this
	 * for production yet...
	 * TODO fix path situation.
	 * @param initStream
	 * @throws IOException
	 */
	@Transactional
	public default void initializeFromStream(InputStream initStream) throws IOException {
		try (CSVParser parser = new CSVParser(new InputStreamReader(initStream), CSVFormat.DEFAULT.withHeader(DESC_HEADER_NAME, ICON_HEADER_NAME))) {
			parser.forEach(this::checkAndAddIfNeccessary);
		}
	}
}
