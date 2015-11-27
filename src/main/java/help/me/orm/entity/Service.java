package help.me.orm.entity;
// Generated Nov 26, 2015 6:04:16 PM by Hibernate Tools 4.3.1.Final

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;
import javax.persistence.UniqueConstraint;

/**
 * Service generated by hbm2java
 */
@SuppressWarnings("serial")
@Entity
@Table(name = "service", uniqueConstraints = @UniqueConstraint(columnNames = "description") )
public class Service implements java.io.Serializable {

	private int serviceId;
	private String description;

	public Service() {
	}

	public Service(int serviceId, String description) {
		this.serviceId = serviceId;
		this.description = description;
	}

	@Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(name = "serviceId", unique = true, nullable = false)
	public int getServiceId() {
		return this.serviceId;
	}

	public void setServiceId(int serviceId) {
		this.serviceId = serviceId;
	}

	@Column(name = "description", unique = true, nullable = false, length = 100)
	public String getDescription() {
		return this.description;
	}

	public void setDescription(String description) {
		this.description = description;
	}

}
