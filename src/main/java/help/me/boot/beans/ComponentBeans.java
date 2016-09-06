package help.me.boot.beans;

import org.springframework.context.annotation.Bean;
import org.springframework.stereotype.Component;

import com.fasterxml.jackson.databind.ObjectMapper;

import help.me.utilities.json.JsonUtilities;

@Component
public class ComponentBeans {
	
	@Bean(name="userMapper")
	public ObjectMapper createUserMapper() {
		return JsonUtilities.createUserObjectMapper();
	}
}
